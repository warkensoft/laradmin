<?php namespace Warkensoft\Laradmin\Fields;

class Hidden extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.hidden';
	}
}