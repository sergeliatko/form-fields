<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputColor
 *
 * @package SergeLiatko\FormFields
 */
class InputColor extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputColor constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'color' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-color',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
