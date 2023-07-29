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
        if( isset($this->parameters['display']) && is_callable($this->parameters['display']) ) {
            return call_user_func($this->parameters['display'], $entry->{$this->parameters['name']});
        }
        else {
            return ( new Carbon($entry->{$this->parameters['name']}) )->format(isset($this->parameters['format']) ? $this->parameters['format'] : 'Y-m-d');
        }
	}
}
