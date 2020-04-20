<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Optgroup as OptgroupTag;
use SergeLiatko\HTML\Option as OptionTag;
use SergeLiatko\HTML\Select as SelectTag;

/**
 * Class Select
 *
 * @package SergeLiatko\FormFields
 */
class Select extends FormField {

	use StaticCallHTMLTrait;

	/**
	 * @param array $input_attrs
	 *
	 * @return \SergeLiatko\FormFields\Select
	 */
	public function setInputAttrs( array $input_attrs ) {
		if ( isset( $input_attrs['multiple'] ) && isset( $input_attrs['name'] ) ) {
			if ( '[]' !== substr( $input_attrs['name'], - 2 ) ) {
				$input_attrs['name'] = $input_attrs['name'] . '[]';
			}
		}

		return parent::setInputAttrs( $input_attrs );
	}

	/**
	 * @param mixed $value
	 *
	 * @return \SergeLiatko\FormFields\Select
	 */
	public function setValue( $value ) {
		return parent::setValue( (array) $value );
	}


	/**
	 * @return string
	 */
	public function getInputHTML() {
		$options = $this->getChoices();
		array_walk( $options, array( $this, 'getOptionHTML' ), $this->getValue() );

		return SelectTag::HTML(
			$this->getInputAttrs(),
			$options
		);
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return $this->parse_args_recursive(
			array(
				'container_attrs' => array(
					'class' => 'form-field form-field-select',
				),
			),
			parent::getDefaultArguments()
		);
	}

	/**
	 * @param mixed  $value
	 * @param string $label
	 * @param array  $current
	 */
	protected function getOptionHTML( &$value, $label = '', array $current = array() ) {
		if ( is_array( $value ) ) {
			array_walk( $value, array( $this, 'getOptionHTML' ), $current );
			$value = OptgroupTag::HTML(
				array(
					'label' => $label,
				),
				$value
			);
		} else {
			$value = in_array( $value, $current ) ?
				OptionTag::HTML(
					array(
						'value'    => $value,
						'selected' => 'selected',
					),
					$label
				)
				: OptionTag::HTML(
					array(
						'value' => $value,
					),
					$label
				);
		}
	}

}
