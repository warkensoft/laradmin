<?php namespace Warkensoft\Laradmin\Services;

use Warkensoft\Laradmin\Controllers\CrudableController;
use Illuminate\Support\Facades\Route;

class LaradminService
{
	public function Routes()
	{
		foreach( config('laradmin.crudable') as $model=>$config )
		{
			$route = $config['route'];
			$controller = isset($config['controller']) ? $config['controller'] : CrudableController::class;
			Route::resource( $route, $controller, ['as' => config('laradmin.adminpath')] )
			     ->middleware( $config['middleware'] ?? config('laradmin.middleware') );
		}
	}

	public function HashedPath($path)
	{
		$buildHash = md5(file_get_contents( dirname(dirname(__DIR__)) . '/build.log' ));
		return $path . '?' . $buildHash;
	}

	public function IsCurrentRoute($testRoute)
	{
		$route = explode('.', request()->route()->getName(), 3);
		return $testRoute == $route[1];
	}

	public function GetModelNameFromRoute()
	{
		$route = explode('.', request()->route()->getName(), 3);

		foreach( config('laradmin.crudable') as $model => $params )
		{
			if($params['route'] == $route[1])
				return $model;
		}

		return '';
	}

	public function GetModelFromRoute()
	{
		$route = explode('.', request()->route()->getName(), 3);

		foreach( config('laradmin.crudable') as $model => $params )
		{
			if($params['route'] == $route[1])
				return Crudable::Get($model);
		}

		return null;
	}
}