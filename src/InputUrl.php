<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputUrl
 *
 * @package SergeLiatko\FormFields
 */
class InputUrl extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputUrl constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'url' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text form-field-url',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
