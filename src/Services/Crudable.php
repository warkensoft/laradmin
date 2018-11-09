<?php namespace Warkensoft\Laradmin\Services;

use Warkensoft\Laradmin\Fields\BaseField;
use Warkensoft\Laradmin\Fields\FieldContract;
use Illuminate\Database\Eloquent\Model;

class Crudable
{
	/** @var Model */
	protected $modelInstance = null;

	/** @var string */
	private $modelname;

	/** @var array */
	private $parameters;

	/** @var array */
	private $defaults = [
		'path'       => '',
		'route'      => '',
		'controller' => 'CrudableController',
		'nav_title'  => '',
		'plural'     => '',
		'singular'   => '',
		'fields'     => [
			[   // Sample field entry
			    'type'        => \Warkensoft\Laradmin\Fields\Textarea::class,
			    'name'        => 'sample',
			    'label'       => 'Page Title',
			    'placeholder' => 'New Page Title Here...',
			    'default'     => '',
			    'rows'        => 6,
			    'rules'       => 'required',
			],
		],
		'index'      => [
			'id'     => 'ID',
			'sample' => 'Sample Entry',
		],
		'sort'       => [
			'key' => 'id',
			'dir' => 'asc',
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

	/**
	 * @param $model_id
	 *
	 * @return Crudable
	 */
	public function load( $model_id )
	{
		$this->modelInstance = $this->modelname::findOrFail($model_id);
		return $this;
	}

	public function model()
	{
		return $this->modelInstance;
	}

	public function create( $values = [] )
	{
		$values = $this->filterValues($values);
		$this->modelInstance = $this->modelname::create($values);

		$this->fields()->each(function (FieldContract $field) {
			$field->handleAfterCreate($this->modelInstance);
		});
	}

	public function update( $values = [] )
	{
		$values = $this->filterValues($values);
		$this->modelInstance->update($values);

		$this->fields()->each(function (FieldContract $field) {
			$field->handleAfterUpdate($this->modelInstance);
		});
	}

	public function delete()
	{
		$this->fields()->each(function (FieldContract $field) {
			$field->handleBeforeDelete($this->modelInstance);
		});

		return $this->modelInstance->delete();
	}

	protected function filterValues( $values )
	{
		return collect($values)
			->map(function ($value, $name) {
				return $this->field($name)->filterValue($value);
			})
			->filter(function ($value) {
				// Hacky way to allow excluding some values from being saved, without preventing save of blanks and nulls.
				return ($value === BaseField::DONT_SAVE_STRING) ? false : true;
			})->all();
	}

	public function fields()
	{
		return collect($this->parameters['fields'])
			->map(function ($field) {
				return $this->field( $field['name'], $field );
			});
	}

	/**
	 * @param string $name
	 * @param null   $params
	 *
	 * @return FieldContract
	 */
	public function field( $name, $params=null )
	{
		if(is_null($params))
		{
			$params = collect($this->parameters['fields'])
				->keyBy('name')
				->get($name);
		}
		if(!is_null($params))
		{
			$classname = $params['type'];
			return new $classname($params);
		}
	}

	public function findValueFor( $fieldname )
	{
		$field = collect($this->parameters->get('fields'))
			->keyBy('name')
			->get($fieldname);

		if( is_null($this->modelInstance) )
		{
			return isset($field['value']) ? $field['value'] : $field['default'];
		}

		if( empty($field['relation']['type']))
			return $this->modelInstance->$fieldname;

		if( $field['relation']['type'] == 'one-to-many' )
			return $this->modelInstance->{$fieldname};

		if( $field['relation']['type'] == 'many-to-many' )
		{
			return $this->modelInstance->{$field['relation']['method']}->pluck($field['relation']['key'])->all();
		}

		throw new \Exception('Unknown relationship type for field: ' . $fieldname);
	}

}