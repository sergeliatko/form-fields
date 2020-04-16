<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Input as InputTag;

/**
 * Class InputRadio
 *
 * @package SergeLiatko\FormFields
 */
class InputRadio extends FormField {

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
	 * InputRadio constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'radio' );
	}

	/**
	 * @param mixed $value
	 *
	 * @return \SergeLiatko\FormFields\FormField
	 */
	public function setValue( $value ) {
		// only one radio button may be selected at a time
		if ( is_array( $value ) ) {
			$value = array_shift( $value );
		}
		// make sure our value is a string
		$value = strval( $value );
		// set checked attribute if needed
		if ( $this->getInputAttribute( 'value' ) == $value ) {
			$this->setInputAttribute( 'checked', 'checked' );
		}

		return parent::setValue( $value );
	}

	/**
	 * @return string
	 */
	public function getInputHTML() {
		return InputTag::HTML( $this->getInputAttrs() );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'before_label'    => true,
				'container_attrs' => array(
					'class' => 'form-field form-field-radio',
				),
			),
			parent::getDefaultArguments()
		);
	}

}
