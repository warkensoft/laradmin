<?php namespace Warkensoft\Laradmin\Services;

use Illuminate\Support\Facades\Route;

class LaradminService
{
	public static function Routes()
	{
		foreach( config('laradmin.crudable') as $model=>$config )
		{
			$route = $config['route'];
			$controller = $config['controller'] ?: 'CrudableController';
			Route::resource( $route, $controller,['as' => 'admin'] );
		}
	}
}