<?php namespace Warkensoft\Laradmin\Fields;

class Select extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.select';
	}

	public function filterValue($value)
	{
		if($value === '0')
			return '0';
		elseif(empty($value))
			return '';
		else
			return $value;
	}
}