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

		/** @noinspection PhpUndefinedMethodInspection */
		return $instance->toHTML();
	}

}
