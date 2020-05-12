<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Button as ButtonTag;

/**
 * Class Button
 *
 * @package SergeLiatko\FormFields
 */
class Button extends FormField {

	use StaticCallHTMLTrait;

	/**
	 * @return string
	 */
	public function getInputHTML() {
		return ButtonTag::HTML(
			$this->getInputAttrs(),
			$this->getValue()
		);
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'input_attrs' => array(
					'class' => 'button button-secondary',
				),
				'container_attrs' => array(
					'class' => 'form-field form-field-button',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
