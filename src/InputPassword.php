<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputPassword
 *
 * @package SergeLiatko\FormFields
 */
class InputPassword extends Input {

	/**
	 * InputPassword constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'password' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text form-field-password',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
