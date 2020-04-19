<?php


namespace SergeLiatko\FormFields;

/**
 * Class Radios
 *
 * @package SergeLiatko\FormFields
 */
class Radios extends FormField {

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function HTML( array $args ) {
		$instance = new self( $args );

		return $instance->toHTML();
	}

	/**
	 * InputRadio constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		parent::__construct( $args );
		$this->setInputAttribute( 'type', 'radio' );
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
			return InputRadio::HTML( $args );
		}
		// we have choices walk them through and create inputs
		$output            = '';
		$id                = $this->getId();
		$args['group']     = false; #do not wrap in a group
		$args['container'] = true; #do wrap in container
		$args['help']      = ''; #remove help message
		foreach ( $choices as $label => $value ) {
			$new_id                       = sanitize_key( sprintf( '%1$s-%2$s', $id, esc_attr( $value ) ) );
			$args['input_attrs']['value'] = $value; #individual value for each choice
			$args['input_attrs']['id']    = $new_id; #individual id for each choice
			$args['label']                = $label; #individual value for each choice
			$args['label_attrs']['for']   = $new_id; #individual id for each label
			$output                       .= InputRadio::HTML( $args );
		}

		return $output;
	}

	/**
	 * @param array $choices
	 *
	 * @return \SergeLiatko\FormFields\Radios
	 */
	public function setChoices( array $choices ) {
		// check if choices is multidimensional array
		if ( $this->isMultiDimensional( $choices ) ) {
			$items = array();
			$this->flattenArray( $choices, $items );

			return parent::setChoices( $items );
		}

		return parent::setChoices( $choices );
	}

	/**
	 * @param array $array
	 *
	 * @return bool
	 */
	protected function isMultiDimensional( array $array ) {
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) || is_object( $value ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @param array $array
	 * @param array $new_array
	 */
	protected function flattenArray( array $array, array &$new_array ) {
		foreach ( $array as $key => $value ) {
			if ( is_array( $value ) ) {
				$this->flattenArray( $value, $new_array );
			} else {
				$new_array[ $key ] = $value;
			}
		}
	}


	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'before_label'    => true,
				'container_attrs' => array(
					'class' => 'form-field form-field-radio',
				),
				'group'           => true,
			),
			parent::getDefaultArguments()
		);
	}

}
