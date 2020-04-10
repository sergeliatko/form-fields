<?php


namespace SergeLiatko\FormFields;

use SergeLiatko\HTML\Tag;

/**
 * Class FormField
 *
 * @package SergeLiatko\FormFields
 */
class FormField {

	/**
	 * @var array $ids Contains all generated HTML ids to avoid collisions.
	 */
	protected static $ids = array();

	/**
	 * @var string $id String used as base for IDs of the input and the form field containers.
	 */
	protected $id;

	/**
	 * @var array $input_attrs Array of input HTML attributes. Keys are attributes and values are values.
	 */
	protected $input_attrs;

	/**
	 * @var mixed $value Current value. May be an array or a scalar value.
	 */
	protected $value;

	/**
	 * @var array $choices An array of applicable choices for the field.
	 *                     Where the key is a label and the value is value.
	 *                     If a value is an array it will be treated as an option group
	 *                     the key will become a label for the option group.
	 */
	protected $choices;

	/**
	 * @var bool $before_label Indicates if the input should be placed before the label.
	 */
	protected $before_label;

	/**
	 * @var string $label Label inner HTML code.
	 */
	protected $label;

	/**
	 * @var array $label_attrs An array of label HTML attributes. Keys are attributes and values are values.
	 */
	protected $label_attrs;

	/**
	 * @var string $label_tag Label HTML tag.
	 */
	protected $label_tag;

	/**
	 * @var string $help Help message inner HTML code.
	 */
	protected $help;

	/**
	 * @var array $help_attrs An array of help message HTML attributes. Keys are attributes and values are values.
	 */
	protected $help_attrs;

	/**
	 * @var string $help_tag Help message HTML tag.
	 */
	protected $help_tag;

	/**
	 * @var bool $container Indicates if the field should be wrapped in a container.
	 */
	protected $container;

	/**
	 * @var array $container_attrs Field container HTML attributes. Keys are attributes and values are values.
	 */
	protected $container_attrs;

	/**
	 * @var string $container_tag Field container HTML tag.
	 */
	protected $container_tag;

	/**
	 * @var bool $group Indicates a field container should be wrapped as a group.
	 */
	protected $group;

	/**
	 * @var array $group_attrs Array of group HTML attributes. Keys are attributes and values are values.
	 */
	protected $group_attrs;

	/**
	 * @var string $group_tag Group HTML tag.
	 */
	protected $group_tag;

	/**
	 * @var string $group_label Group label inner HTML code. Defaults to $label.
	 */
	protected $group_label;

	/**
	 * @var array $group_label_attrs Array of group label HTML attributes. Keys are attributes and values are values.
	 */
	protected $group_label_attrs;

	/**
	 * @var string $group_label_tag Group label HTML tag.
	 */
	protected $group_label_tag;

	/**
	 * @var bool $wrap Indicates if the field input should be wrapped in an HTML tag.
	 */
	protected $wrap;

	/**
	 * @var array $wrap_attrs An array of input wrapper HTML attributes. Keys are attributes and values are values.
	 */
	protected $wrap_attrs;

	/**
	 * @var string $wrap_tag Input wrapper HTML tag.
	 */
	protected $wrap_tag;

	/**
	 * FormField constructor.
	 *
	 * @param array $args
	 */
	public function __construct( array $args ) {
		/**
		 * @var string $id
		 * @var array  $input_attrs
		 * @var mixed  $value
		 * @var array  $choices
		 * @var bool   $before_label
		 * @var string $label
		 * @var array  $label_attrs
		 * @var string $label_tag
		 * @var string $help
		 * @var array  $help_attrs
		 * @var string $help_tag
		 * @var bool   $container
		 * @var array  $container_attrs
		 * @var string $container_tag
		 * @var bool   $group
		 * @var array  $group_attrs
		 * @var string $group_tag
		 * @var string $group_label
		 * @var array  $group_label_attrs
		 * @var string $group_label_tag
		 * @var bool   $wrap
		 * @var array  $wrap_attrs
		 * @var string $wrap_tag
		 */
		extract(
			$this->parse_args_recursive( $args, $this->getDefaultArguments() ),
			EXTR_OVERWRITE
		);
		$this->setInputAttrs( $input_attrs );
		$this->setId( $id );
		$this->setValue( $value );
		$this->setChoices( $choices );
		$this->setBeforeLabel( $before_label );
		$this->setLabel( $label );
		$this->setLabelAttrs( $label_attrs );
		$this->setLabelTag( $label_tag );
		$this->setHelp( $help );
		$this->setHelpAttrs( $help_attrs );
		$this->setHelpTag( $help_tag );
		$this->setContainer( $container );
		$this->setContainerAttrs( $container_attrs );
		$this->setContainerTag( $container_tag );
		$this->setGroup( $group );
		$this->setGroupAttrs( $group_attrs );
		$this->setGroupTag( $group_tag );
		$this->setGroupLabel( $group_label );
		$this->setGroupLabelAttrs( $group_label_attrs );
		$this->setGroupLabelTag( $group_label_tag );
		$this->setWrap( $wrap );
		$this->setWrapAttrs( $wrap_attrs );
		$this->setWrapTag( $wrap_tag );
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->toHTML();
	}

	/**
	 * @return array
	 */
	protected static function getIds() {
		return self::$ids;
	}

	/**
	 * @param array $ids
	 */
	protected static function setIds( $ids ) {
		self::$ids = $ids;
	}

	/**
	 * @param string $id
	 *
	 * @return string
	 */
	protected static function addUniqueId( $id ) {
		if ( in_array( $id, $ids = self::getIds() ) ) {
			$base  = $id;
			$index = 2;
			while ( in_array( $id = sprintf( '%1$s-%2$d', $base, $index ), $ids ) ) {
				$index ++;
			}
		}
		$ids[] = $id;
		self::setIds( $ids );

		return $id;
	}

	/**
	 * @param array $args
	 *
	 * @return \SergeLiatko\FormFields\FormField
	 */
	public static function getInstance( array $args ) {
		return new self( $args );
	}

	/**
	 * @param array $args
	 *
	 * @return string
	 */
	public static function HTML( array $args ) {
		return self::getInstance( $args )->toHTML();
	}

	/**
	 * @return array
	 */
	protected function getDefaultArguments() {
		return array(
			'id'                => '',
			'input_attrs'       => array(),
			'value'             => null,
			'choices'           => array(),
			'before_label'      => false,
			'label'             => '',
			'label_attrs'       => array(),
			'label_tag'         => 'label',
			'help'              => '',
			'help_attrs'        => array(
				'class' => 'form-field-help',
			),
			'help_tag'          => 'p',
			'container'         => false,
			'container_attrs'   => array(
				'class' => 'form-field',
			),
			'container_tag'     => 'div',
			'group'             => false,
			'group_attrs'       => array(
				'class' => 'form-fields',
			),
			'group_tag'         => 'fieldset',
			'group_label'       => '',
			'group_label_attrs' => array(),
			'group_label_tag'   => 'legend',
			'wrap'              => false,
			'wrap_attrs'        => array(),
			'wrap_tag'          => 'div',
		);
	}

	/**
	 * @param array|object $args
	 * @param array|object $default
	 * @param bool         $preserve_integer_keys
	 *
	 * @return array|object
	 */
	protected function parse_args_recursive( $args, $default, $preserve_integer_keys = false ) {

		if ( ! is_array( $default ) && ! is_object( $default ) ) {
			return wp_parse_args( $args, $default );
		}

		$is_object = ( is_object( $args ) || is_object( $default ) );
		$output    = array();

		foreach ( array( $default, $args ) as $elements ) {
			foreach ( (array) $elements as $key => $element ) {
				if ( is_integer( $key ) && ! $preserve_integer_keys ) {
					$output[] = $element;
				} elseif (
					isset( $output[ $key ] ) &&
					( is_array( $output[ $key ] ) || is_object( $output[ $key ] ) ) &&
					( is_array( $element ) || is_object( $element ) )
				) {
					$output[ $key ] = $this->parse_args_recursive(
						$element,
						$output[ $key ],
						$preserve_integer_keys
					);
				} else {
					$output[ $key ] = $element;
				}
			}
		}

		return $is_object ? (object) $output : $output;
	}

	/**
	 * @param string $name
	 *
	 * @return string
	 */
	protected function constructId( $name ) {
		return self::addUniqueId(
			trim(
				preg_replace( '/([^a-z0-9-]+)/', '-', strtolower( trim( $name ) ) ),
				'-'
			)
		);
	}

	/**
	 * @param mixed $data
	 *
	 * @return bool
	 */
	protected function isEmpty( $data = null ) {
		return empty( $data );
	}

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	protected function noEmptyKeys( $key ) {
		return is_string( $key ) && ! empty( $key );
	}

	/**
	 * @return string
	 */
	public function toHTML() {
		return $this->getGroupHTML();
	}

	/**
	 * @return string
	 */
	public function getInputHTML() {
		//this function must be overwritten by the extension of this class.
		return '';
	}

	/**
	 * @return string
	 */
	public function getWrapHTML() {
		return $this->isWrap() ?
			Tag::HTML(
				$this->getWrapAttrs(),
				$this->getInputHTML(),
				$this->getWrapTag(),
				false
			)
			: $this->getInputHTML();
	}

	/**
	 * @return string
	 */
	public function getLabelHTML() {
		return $this->isEmpty( $label = $this->getLabel() ) ? '' :
			Tag::HTML(
				$this->getLabelAttrs(),
				$label,
				$this->getLabelTag(),
				false
			);
	}

	/**
	 * @return string
	 */
	public function getFieldHTML() {
		return $this->isBeforeLabel() ?
			$this->getWrapHTML() . $this->getLabelHTML()
			: $this->getLabelHTML() . $this->getWrapHTML();
	}

	/**
	 * @return string
	 */
	public function getContainerHTML() {
		return $this->isContainer() ?
			Tag::HTML(
				$this->getContainerAttrs(),
				$this->getFieldHTML(),
				$this->getContainerTag(),
				false
			)
			: $this->getFieldHTML();
	}

	/**
	 * @return string
	 */
	public function getGroupLabelHTML() {
		return ( ! $this->isGroup() || $this->isEmpty( $label = $this->getGroupLabel() ) ) ?
			''
			: Tag::HTML(
				$this->getGroupLabelAttrs(),
				$label,
				$this->getGroupLabelTag(),
				false
			);
	}

	/**
	 * @return string
	 */
	public function getGroupHTML() {
		return $this->isGroup() ?
			Tag::HTML(
				$this->getGroupAttrs(),
				$this->getGroupLabelHTML() . $this->getContainerHTML(),
				$this->getGroupTag(),
				false
			)
			: $this->getContainerHTML();
	}

	/**
	 * @return string
	 */
	public function getId() {
		if ( empty( $this->id ) && ! $this->isEmpty( $id = $this->getInputAttribute( 'id' ) ) ) {
			$this->setId( $id );
		}

		return $this->id;
	}

	/**
	 * @param string $id
	 *
	 * @return FormField
	 */
	public function setId( $id = '' ) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getInputAttrs() {
		return $this->input_attrs;
	}

	/**
	 * @param array $input_attrs
	 *
	 * @return FormField
	 */
	public function setInputAttrs( array $input_attrs ) {
		if ( ! isset( $input_attrs['id'] ) || empty( $input_attrs['id'] ) ) {
			if ( ! empty( $input_attrs['name'] ) ) {
				$id                = $this->constructId( $input_attrs['name'] );
				$input_attrs['id'] = $id;
			}
		}
		$this->input_attrs = $input_attrs;

		return $this;
	}

	/**
	 * @param string $name
	 *
	 * @return string|null
	 */
	public function getInputAttribute( $name ) {
		$attributes = (array) $this->getInputAttrs();

		return isset( $attributes[ $name ] ) ? $attributes[ $name ] : null;
	}

	/**
	 * @param string $name
	 * @param string $value
	 *
	 * @return FormField
	 */
	public function setInputAttribute( $name, $value = '' ) {
		$attributes          = (array) $this->getInputAttrs();
		$attributes[ $name ] = strval( $value );
		$this->setInputAttrs( $attributes );

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param mixed $value
	 *
	 * @return FormField
	 */
	public function setValue( $value ) {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getChoices() {
		return $this->choices;
	}

	/**
	 * @param array $choices
	 *
	 * @return FormField
	 */
	public function setChoices( array $choices ) {
		array_walk( $choices, function ( &$value ) {
			if ( is_array( $value ) ) {
				$value = array_filter( $value, array( $this, 'noEmptyKeys' ), ARRAY_FILTER_USE_KEY );
			} else {
				$value = strval( $value );
			}
		} );
		$choices       = array_filter( $choices, array( $this, 'noEmptyKeys' ), ARRAY_FILTER_USE_KEY );
		$this->choices = $choices;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isBeforeLabel() {
		return $this->before_label;
	}

	/**
	 * @param bool $before_label
	 *
	 * @return FormField
	 */
	public function setBeforeLabel( $before_label ) {
		$this->before_label = ! empty( $before_label );

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param string $label
	 *
	 * @return FormField
	 */
	public function setLabel( $label ) {
		$this->label = $label;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getLabelAttrs() {
		return $this->label_attrs;
	}

	/**
	 * @param array $label_attrs
	 *
	 * @return FormField
	 */
	public function setLabelAttrs( array $label_attrs ) {
		if ( ! $this->isEmpty( $id = $this->getId() ) ) {
			$label_attrs = wp_parse_args( $label_attrs, array(
				'for' => $id,
			) );
		}
		$this->label_attrs = $label_attrs;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLabelTag() {
		return $this->label_tag;
	}

	/**
	 * @param string $label_tag
	 *
	 * @return FormField
	 */
	public function setLabelTag( $label_tag ) {
		$this->label_tag = $label_tag;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getHelp() {
		return $this->help;
	}

	/**
	 * @param string $help
	 *
	 * @return FormField
	 */
	public function setHelp( $help ) {
		$this->help = $help;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getHelpAttrs() {
		return $this->help_attrs;
	}

	/**
	 * @param array $help_attrs
	 *
	 * @return FormField
	 */
	public function setHelpAttrs( array $help_attrs ) {
		$this->help_attrs = $help_attrs;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getHelpTag() {
		return $this->help_tag;
	}

	/**
	 * @param string $help_tag
	 *
	 * @return FormField
	 */
	public function setHelpTag( $help_tag ) {
		$this->help_tag = $help_tag;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isContainer() {
		return $this->container;
	}

	/**
	 * @param bool $container
	 *
	 * @return FormField
	 */
	public function setContainer( $container ) {
		$this->container = ! empty( $container );

		return $this;
	}

	/**
	 * @return array
	 */
	public function getContainerAttrs() {
		return $this->container_attrs;
	}

	/**
	 * @param array $container_attrs
	 *
	 * @return FormField
	 */
	public function setContainerAttrs( array $container_attrs ) {
		$this->container_attrs = $container_attrs;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getContainerTag() {
		return $this->container_tag;
	}

	/**
	 * @param string $container_tag
	 *
	 * @return FormField
	 */
	public function setContainerTag( $container_tag ) {
		$this->container_tag = $container_tag;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isGroup() {
		return $this->group;
	}

	/**
	 * @param bool $group
	 *
	 * @return FormField
	 */
	public function setGroup( $group ) {
		$this->group = ! empty( $group );

		return $this;
	}

	/**
	 * @return array
	 */
	public function getGroupAttrs() {
		return $this->group_attrs;
	}

	/**
	 * @param array $group_attrs
	 *
	 * @return FormField
	 */
	public function setGroupAttrs( array $group_attrs ) {
		$this->group_attrs = $group_attrs;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getGroupTag() {
		return $this->group_tag;
	}

	/**
	 * @param string $group_tag
	 *
	 * @return FormField
	 */
	public function setGroupTag( $group_tag ) {
		$this->group_tag = $group_tag;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getGroupLabel() {
		if ( empty( $this->group_label ) && ! $this->isEmpty( $label = $this->getLabel() ) ) {
			$this->setGroupLabel( $label );
		}

		return $this->group_label;
	}

	/**
	 * @param string $group_label
	 *
	 * @return FormField
	 */
	public function setGroupLabel( $group_label ) {
		$this->group_label = $group_label;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getGroupLabelAttrs() {
		return $this->group_label_attrs;
	}

	/**
	 * @param array $group_label_attrs
	 *
	 * @return FormField
	 */
	public function setGroupLabelAttrs( array $group_label_attrs ) {
		$this->group_label_attrs = $group_label_attrs;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getGroupLabelTag() {
		return $this->group_label_tag;
	}

	/**
	 * @param string $group_label_tag
	 *
	 * @return FormField
	 */
	public function setGroupLabelTag( $group_label_tag ) {
		$this->group_label_tag = $group_label_tag;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isWrap() {
		return $this->wrap;
	}

	/**
	 * @param bool $wrap
	 *
	 * @return FormField
	 */
	public function setWrap( $wrap ) {
		$this->wrap = ! empty( $wrap );

		return $this;
	}

	/**
	 * @return array
	 */
	public function getWrapAttrs() {
		return $this->wrap_attrs;
	}

	/**
	 * @param array $wrap_attrs
	 *
	 * @return FormField
	 */
	public function setWrapAttrs( array $wrap_attrs ) {
		$this->wrap_attrs = $wrap_attrs;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getWrapTag() {
		return $this->wrap_tag;
	}

	/**
	 * @param string $wrap_tag
	 *
	 * @return FormField
	 */
	public function setWrapTag( $wrap_tag ) {
		$this->wrap_tag = $wrap_tag;

		return $this;
	}

}
