<?php


namespace SergeLiatko\FormFields;

/**
 * Class InputDateTimeLocal
 *
 * @package SergeLiatko\FormFields
 */
class InputDateTimeLocal extends Input {

	use StaticCallHTMLTrait;

	/**
	 * InputDateTimeLocal constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'datetime-local' );
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-datetime-local',
				),
			),
			parent::getDefaultArguments()
		);
	}
}
