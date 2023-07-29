<?php namespace Warkensoft\Laradmin\Fields;

/**
 * System fields are only used to store or manipulate data and are not parsed in form create/save results.
 */
class System extends BaseField
{
	public function view()
	{
		return '';
	}

    public function filterValue($value)
    {
        return static::DONT_SAVE_STRING;
    }
}
