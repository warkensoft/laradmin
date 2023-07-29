<?php namespace Warkensoft\Laradmin\Fields;

use Illuminate\Support\Str;

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
		return isset($this->parameters[$fieldname]) ? $this->parameters[$fieldname] : null;
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

	public function value(\Illuminate\Foundation\Http\FormRequest $request=null)
	{
		if(empty($request))
			$request = request();
		return $request->get( $this->parameters['name'] );
	}

	public function filterValue($value)
	{
		return $value;
	}

	public function presentationValue($entry)
	{
		if( isset($this->parameters['display']) && is_callable($this->parameters['display']) ) {
			return call_user_func($this->parameters['display'], $entry->{$this->parameters['name']});
		}
		else {
			return $entry->{$this->parameters['name']};
		}
	}

	public function handleAfterCreate($model)
	{
		return $model;
	}

	public function handleAfterUpdate($model)
	{
		return $model;
	}

	public function handleBeforeDelete($model)
	{
		return $model;
	}

}