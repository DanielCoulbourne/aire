<?php

namespace Galahad\Aire\Elements\Attributes;

use Galahad\Aire\Elements\Element;
use Galahad\Aire\Elements\Group;
use Illuminate\Support\Arr;

class ClassNames
{
	/**
	 * Configured default class names
	 *
	 * @var array
	 */
	protected static $default_classes = [];
	
	/**
	 * Configured validation class names
	 *
	 * @var array
	 */
	protected static $validation_classes = [];
	
	/**
	 * The element that this attribute is connected to
	 *
	 * This is necessary to automatically set class names based on
	 * defaults and validation state.
	 *
	 * @var \Galahad\Aire\Elements\Element
	 */
	protected $element;
	
	/**
	 * Manually applied class names
	 *
	 * @var string
	 */
	protected $class_names;
	
	/**
	 * Constructor
	 *
	 * @param \Galahad\Aire\Elements\Element $element
	 */
	public function __construct(Element $element)
	{
		$this->element = $element;
	}
	
	/**
	 * Set the configured default class names
	 *
	 * @param array $default_classes
	 */
	public static function setDefaultClasses(array $default_classes)
	{
		static::$default_classes = $default_classes;
	}
	
	/**
	 * Set the configured validation class names
	 *
	 * @param array $validation_classes
	 */
	public static function setValidationClasses(array $validation_classes)
	{
		static::$validation_classes = $validation_classes;
	}
	
	/**
	 * Set the class name
	 *
	 * @param null|string $class_names
	 * @return \Galahad\Aire\Elements\Attributes\ClassNames
	 */
	public function set(?string $class_names) : self
	{
		$this->class_names = $class_names;
		
		return $this;
	}
	
	/**
	 * Apply defaults, configured, and validation class names
	 *
	 * @return string
	 */
	public function __toString()
	{
		return implode(' ', array_filter([
			$this->defaults(),
			$this->class_names,
			$this->validation(),
		]));
	}
	
	/**
	 * Get default class names for this element
	 *
	 * @return null|string
	 */
	protected function defaults() : ?string
	{
		$key = $this->element->name;
		
		if ('textarea' === $key && !Arr::has(static::$default_classes, 'textarea')) {
			$key = 'input';
		}
		
		return Arr::get(static::$default_classes, $key);
	}
	
	/**
	 * Get validation class names based on the group's validation state
	 *
	 * @return null|string
	 */
	protected function validation() : ?string
	{
		$element_key = $this->element->name;
		
		if ('textarea' === $element_key && !Arr::has(static::$validation_classes, 'textarea')) {
			$element_key = 'input';
		}
		
		if ($this->element->group) {
			$key = "{$this->element->group->validation_state}.{$element_key}";
			return Arr::get(static::$validation_classes, $key);
		}
		
		if ($this->element instanceof Group) {
			$key = "{$this->element->validation_state}.{$element_key}";
			return Arr::get(static::$validation_classes, $key);
		}
		
		return null;
	}
}
