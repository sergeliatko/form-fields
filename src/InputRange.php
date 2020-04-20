<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputRange
 *
 * @package SergeLiatko\FormFields
 */
class InputRange extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputRange constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'range' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-range',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
