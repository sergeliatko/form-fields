<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputSubmit
 *
 * @package SergeLiatko\FormFields
 */
class InputSubmit extends Input {

	/**
	 * InputSubmit constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'submit' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-submit',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
