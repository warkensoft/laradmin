<?php namespace Warkensoft\Laradmin\Fields;

use Illuminate\Support\Carbon;

class DateTime extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.datetime';
	}

	public function presentationValue($entry)
	{
		return (new Carbon($entry->{$this->parameters['name']}))->format(isset($this->parameters['format']) ? $this->parameters['format'] : 'Y-m-d');
	}
}