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
			$controller = isset($config['controller']) ?: CrudableController::class;
			Route::resource( $route, $controller, ['as' => config('laradmin.adminpath')] );
		}
	}

	public function IsCurrentRoute($testRoute)
	{
		$route = explode('.', request()->route()->getName(), 3);
		return $testRoute == $route[1];
	}

	public function FieldValue( $entry, $field )
	{
		$crudable = Crudable::Get( '\\' . get_class($entry) );
		$fieldParams = collect( $crudable->fields )->keyBy( 'field' )->get( $field );

		if( isset($fieldParams['relation']['type']) )
		{
			if($fieldParams['relation']['type'] == 'one-to-many')
			{
				return $entry->{$fieldParams['relation']['name']}->{$fieldParams['relation']['label']};
			}
		}

		return $entry->$field;
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