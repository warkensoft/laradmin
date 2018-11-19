<?php namespace Warkensoft\Laradmin\Fields;

class Select extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.select';
	}

	public function filterValue($value)
	{
		if(empty($value))
			return '';
		else
			return $value;
	}
}