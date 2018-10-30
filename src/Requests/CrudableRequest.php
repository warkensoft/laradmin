<?php namespace Warkensoft\Laradmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Warkensoft\Laradmin\Facade as Laradmin;
use Warkensoft\Laradmin\Services\Crudable;

class CrudableRequest extends FormRequest
{
	public function modelName()
	{
		return Laradmin::GetModelNameFromRoute();
	}

	public function model()
	{
		return Laradmin::GetModelFromRoute();
	}

	public function validatedData()
	{
		$fields = $this->model()->fields;

		$rules = collect($fields)->pluck('rules', 'field')
		                         ->all();
		$this->validate( $rules );

		$fields = $this->assignValues($fields);
		$separated = $this->separateRelations($fields);

		return $separated->get('direct')
		                 ->pluck('value', 'field')
		                 ->all();
	}

	private function assignValues( $fields = [] )
	{
		return collect($fields)->map(function ($field) {

			if( $this->has($field['field']) )
			{
				$value = $this->get($field['field']);
				$field['value'] = $value;
			}
			else
			{
				$field['value'] = $field['default'];
			}

			return $field;
		});
	}

	/**
	 * @param array $fields
	 *
	 * @return Collection
	 */
	private function separateRelations($fields = [])
	{
		return collect( $fields )->map( function ( $field ) {
			$field['relationship_status'] = isset( $field['relation']['type'] ) ? 'relation' : 'direct';
			return $field;
		} )
		->groupBy('relationship_status');
	}

	public function modelData()
	{
		$crudable = $this->model();

		$fieldTypes = $this->fieldTypes($crudable->fields);
		dd($fieldTypes);

		$values = collect($crudable->fields)
			->filter(function ($field) {
				if( isset($field['relation']['type']) )
					if($field['relation']['type'] == 'many-to-many')
						return false;
				return true;
			})
			->map(function ($field) {
				$field['value'] = $this->has($field['field']) ? $this->get($field['field']) : $field['default'];
				return $field;
			})
			->pluck('value', 'field')
			->all();

		return $values;
	}

	public function relationshipData()
	{
		$crudable = $this->model();
		$fields = collect($crudable->fields)
			->filter(function ($field) {
				if( isset($field['relation']['type']) )
					if($field['relation']['type'] == 'many-to-many')
						return true;
				return false;
			})
			->map(function ($field) {
				$field['value'] = $this->get($field['field']);
				return $field;
			})
			->pluck('value', 'field')
			->all();

		return $fields;
	}

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
