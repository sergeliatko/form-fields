<?php


namespace SergeLiatko\FormFields;

/**
 * Trait ScriptsTrait
 *
 * @package SergeLiatko\FormFields
 */
trait ScriptsTrait {

	/**
	 * @var array $styles
	 */
	protected static $styles;

	/**
	 * @var array $scripts
	 */
	protected static $scripts;

	/**
	 * @var bool $did_scripts
	 */
	protected static $did_scripts;

	/**
	 * Enqueues the scripts and styles when called.
	 */
	public static function loadScripts() {
		if ( !self::isDidScripts() ) {
			foreach ( self::getStyles() as $style ) {
				call_user_func_array( 'wp_enqueue_style', $style );
			}
			foreach ( self::getScripts() as $script ) {
				call_user_func_array( 'wp_enqueue_script', $script );
			}
			self::afterEnqueuedScripts();
			self::setDidScripts( true );
		}
	}

	/**
	 * @return bool
	 */
	public static function isDidScripts(): bool {
		return !empty( self::$did_scripts );
	}

	/**
	 * @param bool $did_scripts
	 */
	public static function setDidScripts( bool $did_scripts ): void {
		self::$did_scripts = $did_scripts;
	}

	/**
	 * @return array
	 */
	public static function getStyles(): array {
		return (array) self::$styles;
	}

	/**
	 * @param array $styles
	 *
	 * @noinspection PhpUnused
	 */
	public static function setStyles( array $styles ): void {
		self::$styles = $styles;
	}

	/**
	 * @return array
	 */
	public static function getScripts(): array {
		return (array) self::$scripts;
	}

	/**
	 * @param array $scripts
	 *
	 * @noinspection PhpUnused
	 */
	public static function setScripts( array $scripts ): void {
		self::$scripts = $scripts;
	}

	/**
	 * Called immediately after the scripts and styles were enqueued.
	 * Can be overwritten by class extensions to hook in there and localize the scripts.
	 */
	protected static function afterEnqueuedScripts() {
	}

	/**
	 * @param string $path
	 *
	 * @return string
	 * @noinspection PhpUnused
	 */
	protected static function pathToUrl( string $path ): string {
		return esc_url_raw(
			str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			),
			array( 'http', 'https' )
		);
	}

	/**
	 * @param $url
	 *
	 * @return string
	 * @noinspection PhpUnused
	 */
	protected static function maybeMinify( $url ) {
		$min = self::min();

		return empty( $min ) ? $url
			: preg_replace( '/(?<!\.min)(\.js|\.css)/', "{$min}$1", $url );
	}

	/**
	 * Returns .min if script debug is not enabled.
	 *
	 * @return string
	 */
	protected static function min() {
		return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	}
}
