<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputDate
 *
 * @package SergeLiatko\FormFields
 */
class InputDate extends Input {

	/**
	 * InputDate constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'date' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-date',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
