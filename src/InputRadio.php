<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputRadio
 *
 * @package SergeLiatko\FormFields
 */
class InputRadio extends InputCheckbox {

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
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-radio',
				),
			),
			parent::getDefaultArguments()
		);
	}

}