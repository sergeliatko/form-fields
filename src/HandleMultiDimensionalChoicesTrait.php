<?php


namespace SergeLiatko\FormFields;

/**
 * Trait HandleMultiDimensionalChoicesTrait
 *
 * @package SergeLiatko\FormFields
 */
trait HandleMultiDimensionalChoicesTrait {

	/**
	 * @param array $choices
	 *
	 * @return \SergeLiatko\FormFields\HandleMultiDimensionalChoicesTrait|\SergeLiatko\FormFields\FormField
	 * @noinspection PhpUndefinedClassInspection
	 * @noinspection PhpUnused
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

}
