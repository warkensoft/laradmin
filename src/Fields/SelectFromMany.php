<?php namespace Warkensoft\Laradmin\Fields;

class SelectFromMany extends BaseField
{
	public function view()
	{
		return 'laradmin::partials.fields.select-from-many';
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
        elseif( $entry->{$this->parameters['relation']['method']} )
		{
			$ret = $entry->{$this->parameters['relation']['method']}->{$this->parameters['relation']['label']};
			return $ret;
		}
		else
			return '';
	}

	public function filterValue($value)
	{
		if(empty($value))
			return null;
		else
			return $value;
	}
}
