<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputTime
 *
 * @package SergeLiatko\FormFields
 */
class InputTime extends Input {

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
	 * InputTime constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'time' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-time',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
