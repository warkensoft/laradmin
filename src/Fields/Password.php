<?php namespace Warkensoft\Laradmin\Fields;

use Illuminate\Support\Facades\Hash;

class Password extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.password';
	}

	public function filterValue($value)
	{
		if(empty($value))
			return static::DONT_SAVE_STRING;

		return Hash::make($value);
	}
}