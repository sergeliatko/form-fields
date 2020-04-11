<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputReset
 *
 * @package SergeLiatko\FormFields
 */
class InputReset extends Input {

	/**
	 * InputReset constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'reset' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-reset',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
