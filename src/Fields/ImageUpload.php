<?php namespace Warkensoft\Laradmin\Fields;

class ImageUpload extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.image-upload';
	}

	public function filterValue($value)
	{
		$uploadedFile = request()->file($this->parameters['name']);
		if(!$uploadedFile)
			return static::DONT_SAVE_STRING;

//		$original_name = $uploadedFile->getClientOriginalName();
//		$original_type = $uploadedFile->getClientMimeType();

		$filename = $uploadedFile->store($this->parameters['path']);

		$path = $this->parameters['uri'] . str_replace($this->parameters['path'], '', $filename);

		return $path;
	}

	public function presentationValue($entry)
	{
		return "<img src='{$entry->{$this->parameters['name']}}' />";
	}
}