<?php namespace Warkensoft\Laradmin\Services;

use Illuminate\Support\Facades\Route;

class Crudable
{

	public static function Routes()
	{
		foreach( config('laradmin.crudable') as $model )
		{
			$name = $model::Crudable()->route;
			$controller = $model::Crudable()->controller ?: 'CrudableController';
			Route::resource( $name, $controller,['as' => 'admin'] );
		}
	}


	/** @var array */
	private $parameters;

	private $defaults = [
		'path'      => '',
		'route'     => '',
		'controller' => 'CrudableController',
		'nav_title' => '',
		'plural'    => '',
		'singular'  => '',
		'fields'    => [
			[
				'field'       => 'sample',
				'type'        => 'input',
				'label'       => 'Page Title',
				'placeholder' => 'New Page Title Here...',
				'default'     => '',
				'rows'        => 6,
			],
		],
		'index'     => [
			'id'    => 'ID',
		],
		'rules'     => [
		],
		'sort'     => [
			'key'    => 'id',
			'dir'    => 'asc',
		],
	];




	public function __construct( $parameters = [] )
	{
		$this->parameters = collect( array_merge($this->defaults, $parameters) );
	}

	public static function FieldValue( $entry, $field )
	{
		$model = get_class($entry);
		$fieldParams = collect( $model::Crudable()->fields )->keyBy( 'field' )->get( $field );

		if( isset($fieldParams['relation']['type']) )
		{
			if($fieldParams['relation']['type'] == 'one-to-many')
			{
				return $entry->{$fieldParams['relation']['name']}->{$fieldParams['relation']['label']};
			}
		}

		return $entry->$field;
	}

	public function IsCurrentRoute()
	{
		$route = explode('.', request()->route()->getName(), 3);
		return $this->route == $route[1];
	}

	public function __get( $param )
	{
		return $this->parameters->get($param);
	}

	public static function GetModelFromRoute()
	{
		$route = explode('.', request()->route()->getName(), 3);

		foreach( config('laradmin.crudable') as $model )
		{
			if($model::Crudable()->route == $route[1])
				return $model;
		}
	}
}