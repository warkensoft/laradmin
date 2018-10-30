<?php namespace Warkensoft\Laradmin\Services;

use Illuminate\Support\Facades\Route;

class Crudable
{
	/** @var string */
	private $modelname;

	/** @var array */
	private $parameters;

	/** @var array */
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

	/**
	 * @param $modelname
	 *
	 * @return Crudable
	 * @throws \Exception
	 */
	public static function Get( $modelname )
	{
		$config = config('laradmin.crudable');
		if(isset($config[$modelname]))
			return new static($modelname, $config[$modelname]);
		else
			throw new \Exception('Unknown model ' . $modelname);
	}

	/**
	 * Crudable constructor.
	 *
	 * @param string $modelname
	 * @param array  $parameters
	 */
	private function __construct( $modelname, $parameters = [] )
	{
		$this->modelname = $modelname;
		$this->parameters = collect( array_merge($this->defaults, $parameters) );
	}

	public function modelname()
	{
		return $this->modelname;
	}

	public function __get( $param )
	{
		return $this->parameters->get($param);
	}

}