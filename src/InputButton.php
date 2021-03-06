<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputButton
 *
 * @package SergeLiatko\FormFields
 */
class InputButton extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputButton constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'button' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-button',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
