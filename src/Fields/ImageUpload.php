<?php namespace Warkensoft\Laradmin\Fields;

class ImageUpload extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.image-upload';
	}

	public function presentationValue($entry)
	{
        if( isset($this->parameters['display']) && is_callable($this->parameters['display']) ) {
            return call_user_func($this->parameters['display'], $entry->{$this->parameters['name']});
        }
        else {
            return "<img src='{$entry->{$this->parameters['name']}}' />";
        }
	}

	public function filterValue($value)
	{
		if(empty($value))
			return '';
		else
			return $value;
	}
}
