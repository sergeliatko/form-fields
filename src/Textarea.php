<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Textarea as TextareaTag;

/**
 * Class Textarea
 *
 * @package SergeLiatko\FormFields
 */
class Textarea extends FormField {

	use StaticCallHTMLTrait;

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-textarea',
				),
			),
			parent::getDefaultArguments()
		);
	}

	/**
	 * @return string
	 */
	public function getInputHTML() {
		return TextareaTag::HTML(
			$this->getInputAttrs(),
			$this->getValue()
		);
	}

	/**
	 * @param mixed $value
	 *
	 * @return \SergeLiatko\FormFields\FormField
	 */
	public function setValue( $value ) {
		if ( is_array( $value ) ) {
			$value = array_shift( $value );
		}
		$value = sanitize_textarea_field( strval( $value ) );

		return parent::setValue( $value );
	}

}
