<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputEmail
 *
 * @package SergeLiatko\FormFields
 */
class InputEmail extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputEmail constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'email' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text form-field-email',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
