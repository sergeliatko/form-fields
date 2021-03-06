<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputText
 *
 * @package SergeLiatko\FormFields
 */
class InputText extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputText constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'text' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text',
				),
			),
			parent::getDefaultArguments()
		);
	}

}
