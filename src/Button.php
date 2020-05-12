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
}
