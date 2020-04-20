<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputNumber
 *
 * @package SergeLiatko\FormFields
 */
class InputNumber extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputNumber constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'number' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text form-field-number',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
