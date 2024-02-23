<?php


namespace SergeLiatko\FormFields;

/**
 * Class StaticCallHTMLTrait
 *
 * @package SergeLiatko\FormFields
 */
trait StaticCallHTMLTrait {

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function HTML( array $args ) {
		$instance = new self( $args );

		return $instance->toHTML();
	}

}
