<?php namespace Warkensoft\Laradmin\Fields;

abstract class BaseField implements FieldContract {

	protected $parameters = [];

	// Return this field from filterValue() if the data for the field should not be saved.
	const DONT_SAVE_STRING = '### EXCLUDE VALUE FROM ELOQUENT SAVE ###';

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

	public function __set( $fieldname, $value ) {
		$this->parameters[$fieldname] = $value;
	}

	public function view()
	{
		return 'laradmin::partials.fields.input';
	}

	public function parameters()
	{
		return $this->parameters;
	}

	public function value(\Illuminate\Foundation\Http\FormRequest $request)
	{
		return $request->get( $this->parameters['name'] );
	}

	public function filterValue($value)
	{
		return $value;
	}

}