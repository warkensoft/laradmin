<?php namespace Warkensoft\Laradmin\Fields;

class Checkbox extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.checkbox';
	}

	public function presentationValue($entry)
	{
        if( isset($this->parameters['display']) && is_callable($this->parameters['display']) ) {
            return call_user_func($this->parameters['display'], $entry->{$this->parameters['name']});
        }
        else {
            return $entry->{$this->parameters['name']} ? 'true' : '';
        }
	}
}
