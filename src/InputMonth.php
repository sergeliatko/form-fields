<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputMonth
 *
 * @package SergeLiatko\FormFields
 */
class InputMonth extends Input {

	/**
	 * InputMonth constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'month' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-month',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
