<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Input as InputTag;

/**
 * Class Input
 *
 * @package SergeLiatko\FormFields
 */
class Input extends FormField {

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function HTML( array $args ) {
		$instance = new self( $args );

		return $instance->toHTML();
	}

	/**
	 * @return string
	 */
	public function getInputHTML() {
		return InputTag::HTML(
			$this->getInputAttrs()
		);
	}

	/**
	 * @param string $value
	 *
	 * @return \SergeLiatko\FormFields\FormField
	 */
	public function setValue( $value = '' ) {

		// simple input value cannot be an array
		if ( is_array( $value ) ) {
			$value = array_shift( $value );
		}

		// convert to string for HTML
		$value = strval( $value );

		// overwrite value in input attributes with the current value
		$this->setInputAttribute( 'value', $value );

		return parent::setValue( $value );
	}

}
