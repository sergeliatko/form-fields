<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputTel
 *
 * @package SergeLiatko\FormFields
 */
class InputTel extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputTel constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'tel' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text form-field-tel',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
