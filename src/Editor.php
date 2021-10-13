<?php


namespace SergeLiatko\FormFields;

/**
 * Class Editor
 *
 * @package SergeLiatko\FormFields
 */
class Editor extends Code {

	use StaticCallHTMLTrait;

	/**
	 * @var array $editor_settings
	 */
	protected $editor_settings;

	/**
	 * @return array
	 */
	public function getEditorSettings(): array {
		if ( !is_array( $this->editor_settings ) ) {
			$this->setEditorSettings( array() );
		}

		return $this->editor_settings;
	}

	/**
	 * @param array $editor_settings
	 *
	 * @return Editor
	 */
	public function setEditorSettings( array $editor_settings ): Editor {
		$this->editor_settings = wp_parse_args( $editor_settings, $this->getDefaultEditorSettings() );

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getInputHTML(): string {
		ob_start();
		wp_editor(
			$this->getValue(),
			$this->getInputAttribute( 'id' ),
			$this->getEditorSettings()
		);

		return ob_get_clean();
	}

	/**
	 * @inheritDoc
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-editor',
				),
				'editor_settings' => $this->getDefaultEditorSettings(),
			),
			parent::getDefaultArguments()
		);
	}

	/**
	 * @inheritDoc
	 */
	protected function beforeLoaded( array $args = array() ): array {
		$name            = empty( $args['input_attrs']['name'] ) ? '' : $args['input_attrs']['name'];
		$editor_settings = ( empty( $args['editor_settings'] ) || !is_array( $args['editor_settings'] ) ) ?
			$this->getDefaultEditorSettings()
			: $args['editor_settings'];
		$this->setEditorSettings(
			wp_parse_args(
				array(
					'textarea_name' => $name,
				),
				$editor_settings
			)
		);

		return parent::beforeLoaded( $args );
	}


	/**
	 * @return array
	 */
	protected function getDefaultEditorSettings(): array {
		return array(
			'wpautop'             => true,
			'media_buttons'       => true,
			'default_editor'      => '',
			'drag_drop_upload'    => false,
			'textarea_name'       => '',
			'textarea_rows'       => 15,
			'tabindex'            => '',
			'tabfocus_elements'   => ':prev,:next',
			'editor_css'          => '',
			'editor_class'        => '',
			'teeny'               => false,
			'_content_editor_dfw' => false,
			'tinymce'             => true,
			'quicktags'           => true,
		);
	}

}
