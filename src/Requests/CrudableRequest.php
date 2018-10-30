<?php namespace Warkensoft\Laradmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Warkensoft\Laradmin\Facade as Laradmin;

class CrudableRequest extends FormRequest
{
	public function modelName()
	{
		return Laradmin::GetModelFromRoute();
	}

	public function validatedData()
	{
		$model = $this->modelName();
		$this->validate( $model::Crudable()->rules );   // as documented https://laravel.com/docs/5.6/validation#quick-writing-the-validation-logic

		$values = collect($model::Crudable()->fields)
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
		$model = $this->modelName();
		$fields = collect($model::Crudable()->fields)
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
