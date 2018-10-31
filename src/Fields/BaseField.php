<?php namespace Warkensoft\Laradmin\Fields;

abstract class BaseField implements \ArrayAccess {

	use ArrayAccessTrait;

	protected $parameters = [];

	public static function Setup( $parameters = [] )
	{
		return new static($parameters);
	}

	public function __construct( $parameters = [] )
	{
		$this->parameters = $parameters;
	}

	public function __get( $fieldname )
	{
		return $this->parameters[$fieldname];
	}

	public function viewname()
	{
		return 'laradmin::partials.fields.input';
	}

	public function parameters()
	{
		return $this->parameters;
	}

}