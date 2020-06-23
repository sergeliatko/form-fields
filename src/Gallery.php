<?php


namespace SergeLiatko\FormFields;


use SergeLiatko\HTML\Button as HTMLButton;
use SergeLiatko\HTML\Div as HTMLDiv;
use SergeLiatko\HTML\Input as HTMLInput;

/**
 * Class Gallery
 *
 * @package SergeLiatko\FormFields
 */
class Gallery extends FormField {
	use StaticCallHTMLTrait, ScriptsTrait;

	/**
	 * @var string $button_label
	 */
	protected $button_label;

	/**
	 * @var string $image_size
	 */
	protected $image_size;

	/**
	 * @var string $remove_label
	 */
	protected $remove_label;

	/**
	 * @var string $window_action
	 */
	protected $window_action;

	/**
	 * @var string $window_title
	 */
	protected $window_title;

	/**
	 * @return array
	 */
	public static function getStyles(): array {
		return array(
			'form-field-gallery' => array(
				'form-field-gallery',
				self::maybeMinify( self::pathToUrl( dirname( dirname( __FILE__ ) ) . '/includes/css/gallery.css' ) ),
				array( 'dashicons' ),
				null,
				'all',
			),
		);
	}

	public static function getScripts(): array {
		return array(
			'form-field-gallery' => array(
				'form-field-gallery',
				self::maybeMinify( self::pathToUrl( dirname( dirname( __FILE__ ) ) . '/includes/js/gallery.js' ) ),
				array( 'jquery-ui-sortable', 'media-upload' ),
				null,
				true,
			),
		);
	}

	/**
	 * Enqueues media scripts.
	 */
	protected static function afterEnqueuedScripts() {
		wp_enqueue_media();
	}

	/**
	 * @param mixed $value
	 *
	 * @return \SergeLiatko\FormFields\Gallery
	 */
	public function setValue( $value ): Gallery {
		return parent::setValue( $this->sanitize_array_of_ids( (array) $value ) );
	}

	/**
	 * @param array $ids
	 *
	 * @return array
	 */
	protected function sanitize_array_of_ids( array $ids = array() ): array {
		return array_filter( array_map( 'absint', $ids ) );
	}

	/**
	 * @param array $input_attrs
	 *
	 * @return \SergeLiatko\FormFields\Gallery
	 */
	public function setInputAttrs( array $input_attrs ): Gallery {
		if ( !empty( $input_attrs['name'] ) && ( false === strpos( $input_attrs['name'], '[]' ) ) ) {
			$input_attrs['name'] = $input_attrs['name'] . '[]';
		}

		return parent::setInputAttrs( $input_attrs );
	}

	/**
	 * @return string
	 */
	public function getInputHTML(): string {
		//load scripts first
		self::loadScripts();
		//prepare items
		$items = array_filter( array_map( array( $this, 'getGalleryItemHTML' ), $this->getValue() ) );

		return join( '', array(
			HTMLDiv::HTML(
				array(
					'class' => 'gallery-items-wrapper',
					'id'    => $this->getId(),
				),
				join( '', $items )
			),
			HTMLButton::HTML( array(
				'class'              => 'button button-secondary edit-gallery-button',
				'data-image-size'    => $this->getImageSize(),
				'data-name'          => $this->getInputAttribute( 'name' ),
				'data-remove-label'  => $this->getRemoveLabel(),
				'data-target-id'     => $this->getId(),
				'data-window-action' => $this->getWindowAction(),
				'data-window-title'  => $this->getWindowTitle(),
			), $this->getButtonLabel() ),
		) );
	}

	/**
	 * @return string
	 */
	public function getImageSize(): string {
		return $this->image_size;
	}

	/**
	 * @param string $image_size
	 *
	 * @return Gallery
	 */
	public function setImageSize( string $image_size ): Gallery {
		$this->image_size = in_array( $image_size, $this->getAllowedImageSizes() ) ? $image_size : 'medium';

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRemoveLabel(): string {
		return $this->remove_label;
	}

	/**
	 * @param string $remove_label
	 *
	 * @return Gallery
	 */
	public function setRemoveLabel( string $remove_label ): Gallery {
		$this->remove_label = $remove_label;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getWindowAction(): string {
		return $this->window_action;
	}

	/**
	 * @param string $window_action
	 *
	 * @return Gallery
	 */
	public function setWindowAction( string $window_action ): Gallery {
		$this->window_action = $window_action;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getWindowTitle(): string {
		return $this->window_title;
	}

	/**
	 * @param string $window_title
	 *
	 * @return Gallery
	 */
	public function setWindowTitle( string $window_title ): Gallery {
		$this->window_title = $window_title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getButtonLabel(): string {
		return $this->button_label;
	}

	/**
	 * @param string $button_label
	 *
	 * @return Gallery
	 */
	public function setButtonLabel( string $button_label ): Gallery {
		$this->button_label = $button_label;

		return $this;
	}

	/**
	 * @param int $id
	 *
	 * @return string
	 */
	protected function getGalleryItemHTML( int $id ): string {
		return $this->isEmpty( $image = wp_get_attachment_image( $id, $this->getImageSize(), false, array(
			'class' => 'gallery-item-image',
		) ) ) ? ''
			: HTMLDiv::HTML(
				array( 'class' => 'gallery-item' ),
				join( '', array(
					$image,
					sprintf(
						'<span class="%1$s" title="%2$s"></span>',
						'gallery-item-remove',
						esc_attr( $this->getRemoveLabel() )
					),
					HTMLInput::HTML( array_filter( wp_parse_args( array(
						'id'    => '',
						'value' => $id,
					), $this->getInputAttrs() ) ) ),
				) )
			);
	}

	/**
	 * @return string[]
	 */
	protected function getAllowedImageSizes(): array {
		return get_intermediate_image_sizes();
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments(): array {
		return $this->parse_args_recursive( array(
			'input_attrs'   => array(
				'type' => 'hidden',
			),
			'button_label'  => __( 'Edit Gallery' ),
			'image_size'    => 'medium',
			'remove_label'  => __( 'Delete' ),
			'window_title'  => __( 'Edit Gallery' ),
			'window_action' => __( 'Insert gallery' ),
			'value'         => array(),
		), parent::getDefaultArguments() );
	}

	/**
	 * @param array $args
	 *
	 * @return array
	 */
	protected function beforeLoaded( array $args = array() ): array {
		/**
		 * @var string       $button_label
		 * @var string       $image_size
		 * @var string       $remove_label
		 * @var array|string $value
		 * @var string       $window_action
		 * @var string       $window_title
		 */
		extract( $args, EXTR_OVERWRITE );
		$this->setButtonLabel( $button_label );
		$this->setImageSize( $image_size );
		$this->setRemoveLabel( $remove_label );
		$this->setWindowAction( $window_action );
		$this->setWindowTitle( $window_title );

		return $args;
	}


}
