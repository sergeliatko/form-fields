<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputSearch
 *
 * @package SergeLiatko\FormFields
 */
class InputSearch extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputSearch constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'search' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-text form-field-search',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
