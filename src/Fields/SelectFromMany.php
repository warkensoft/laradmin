<?php namespace Warkensoft\Laradmin\Fields;

class SelectFromMany extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.select-from-many';
	}

	public function related()
	{
		return $this->parameters['relation']['model']::all();
	}

	public function presentationValue($entry)
	{
		return $entry->{$this->parameters['relation']['method']}->{$this->parameters['relation']['label']};
	}
}