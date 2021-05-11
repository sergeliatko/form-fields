<?php


namespace SergeLiatko\FormFields;

/**
 * Class Code
 *
 * @package SergeLiatko\FormFields
 */
class Code extends Textarea {

	use StaticCallHTMLTrait;

	/**
	 * @param mixed $value
	 *
	 * @return \SergeLiatko\FormFields\FormField
	 */
	public function setValue( $value ): FormField {
		if ( is_array( $value ) ) {
			$value = strval( array_shift( $value ) );
		}
		$this->value = $value;

		return $this;
	}

}
