<?php namespace Warkensoft\Laradmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade as BaseFacade;
use Warkensoft\Laradmin\Services\Crudable;
use Warkensoft\Laradmin\Services\LaradminService;

/**
 * Class Facade
 *
 * @method static string Routes()
 * @method static string IsCurrentRoute($modelFields)
 * @method static Crudable GetModelFromRoute()
 *
 * @package Warkensoft\Laradmin
 */
class Facade extends BaseFacade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return LaradminService::class; }
}
