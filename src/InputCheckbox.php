<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Input as InputTag;

/**
 * Class InputCheckbox
 *
 * @package SergeLiatko\FormFields
 */
class InputCheckbox extends FormField {

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
	 * InputCheckbox constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'checkbox' );
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
					'class' => 'form-field form-field-checkbox',
				),
			),
			parent::getDefaultArguments()
		);
	}

	/**
	 * @param mixed $value
	 *
	 * @return \SergeLiatko\FormFields\FormField
	 */
	public function setValue( $value ) {
		if ( ! is_array( $value ) ) {
			$value = array( strval( $value ) );
		}
		if (
			! $this->isEmpty( $value_attr = strval( $this->getInputAttribute( 'value' ) ) )
			&& in_array( $value_attr, $value )
		) {
			$this->setInputAttribute( 'checked', 'checked' );
		}

		return parent::setValue( $value );
	}
}
