<?php namespace Warkensoft\Laradmin\Fields;

class Checkbox extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.checkbox';
	}

	public function presentationValue($entry)
	{
		return $entry->{$this->parameters['name']} ? 'true' : '';
	}
}