<?php namespace Warkensoft\Laradmin\Fields;

class SelectManyFromMany extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.select-many-from-many';
	}

	public function related()
	{
		return $this->parameters['relation']['model']::orderBy( $this->parameters['relation']['label'] )->get();
	}

	public function presentationValue($entry)
	{
        if( isset($this->parameters['display']) && is_callable($this->parameters['display']) ) {
            return call_user_func($this->parameters['display'], $entry->{$this->parameters['name']});
        }
        elseif( $entry->{$this->parameters['relation']['method']}->count() )
		{
			$ret = $entry->{$this->parameters['relation']['method']}->pluck($this->parameters['relation']['label'])->implode(', ');
			return substr($ret, 0, 15) . (strlen($ret) > 15 ? '...' : '');
		}
		else
			return '';
	}

	public function filterValue($value)
	{
		return static::DONT_SAVE_STRING;
	}

	public function handleAfterCreate( $modelInstance )
	{
		$savedValues = collect($this->value())->filter();
		$modelInstance->{$this->parameters['relation']['method']}()->sync($savedValues);
	}

	public function handleAfterUpdate( $modelInstance )
	{
		$savedValues = collect($this->value())->filter();
		$modelInstance->{$this->parameters['relation']['method']}()->sync($savedValues);
	}

	public function handleBeforeDelete( $modelInstance )
	{

	}
}
