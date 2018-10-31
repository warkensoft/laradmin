<?php namespace Warkensoft\Laradmin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Warkensoft\Laradmin\Facade as Laradmin;
use Warkensoft\Laradmin\Fields\FieldContract;
use Warkensoft\Laradmin\Services\Crudable;

class CrudableRequest extends FormRequest
{
	public function modelName()
	{
		return Laradmin::GetModelNameFromRoute();
	}

	public function crudable()
	{
		return Laradmin::GetModelFromRoute();
	}

	public function validatedData()
	{
		$fields = collect($this->crudable()->fields);

		$rules = $fields->pluck('rules', 'name')
		                ->all();

		$this->validate( $rules );

		return $this->assignValues($fields)->toArray();
	}

	private function assignValues( Collection $fields )
	{
		return $fields->keyBy('name')->map(function ($field) {
			return $this->buildFieldObject($field)->value($this);
		});
	}

	/**
	 * @param array $fieldParams
	 * @return FieldContract
	 */
	private function buildFieldObject( $fieldParams )
	{
		return new $fieldParams['type']($fieldParams);
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
