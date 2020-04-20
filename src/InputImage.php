<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputImage
 *
 * @package SergeLiatko\FormFields
 */
class InputImage extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputImage constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'image' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-image',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
