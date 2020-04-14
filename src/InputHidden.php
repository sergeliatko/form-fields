<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputHidden
 *
 * @package SergeLiatko\FormFields
 */
class InputHidden extends Input {

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
	 * InputHidden constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'hidden' );
	}

}
