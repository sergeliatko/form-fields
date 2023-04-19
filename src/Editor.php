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
	 * @return array
	 */
	public function getEditorSettings(): array {
		return array_diff_key(
			wp_parse_args(
				wp_parse_args(
					$this->getInputAttrs(),
					array(
						'textarea_name' => $this->getInputAttribute( 'name' ),
					)
				),
				$this->getDefaultEditorSettings()
			),
			array(
				'id'   => '',
				'name' => '',
			)
		);
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
			),
			parent::getDefaultArguments()
		);
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
