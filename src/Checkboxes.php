<?php


namespace SergeLiatko\FormFields;

/**
 * Class Checkboxes
 *
 * @package SergeLiatko\FormFields
 */
class Checkboxes extends FormField {

	use HandleMultiDimensionalChoicesTrait, StaticCallHTMLTrait;

	/**
	 * InputRadio constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'checkbox' );
	}

	/**
	 * @return string
	 */
	public function getInputHTML() {
		$args = array_filter( get_object_vars( $this ) );
		// set $before_label explicitly (as if it is false it was done on purpose)
		$args['before_label'] = $this->isBeforeLabel();
		// handle the case when no choices is provided - output as a group with the only input
		if ( $this->isEmpty( $choices = $this->getChoices() ) ) {
			return InputCheckbox::HTML( $args );
		}
		// we have choices walk them through and create inputs
		$output            = '';
		$id                = $this->getId();
		$args['group']     = false; #do not wrap in a group
		$args['container'] = true; #do wrap in container
		$args['help']      = ''; #remove help message
		// make sure the data is sent as an array
		if ( '[]' !== substr( $args['input_attrs']['name'], - 2 ) ) {
			$args['input_attrs']['name'] = $args['input_attrs']['name'] . '[]';
		}
		foreach ( $choices as $label => $value ) {
			$new_id                       = sanitize_key( join( '-', array( $id, esc_attr( $value ) ) ) );
			$args['id']                   = $new_id;
			$args['input_attrs']['id']    = $new_id;
			$args['input_attrs']['value'] = $value;
			$args['label']                = $label;
			$args['label_attrs']['for']   = $new_id;
			$output                       .= InputCheckbox::HTML( $args );
		}

		return $output;
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'before_label'    => true,
				'container_attrs' => array(
					'class' => 'form-field form-field-checkbox',
				),
				'group'           => true,
			),
			parent::getDefaultArguments()
		);
	}
}
