<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputFile
 *
 * @package SergeLiatko\FormFields
 */
class InputFile extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputFile constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'file' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-file',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
