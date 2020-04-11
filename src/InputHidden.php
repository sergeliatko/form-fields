<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputHidden
 *
 * @package SergeLiatko\FormFields
 */
class InputHidden extends Input {

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
