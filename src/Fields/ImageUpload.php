<?php namespace Warkensoft\Laradmin\Fields;

class ImageUpload extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.image-upload';
	}

	public function presentationValue($entry)
	{
		return "<img src='{$entry->{$this->parameters['name']}}' />";
	}
}