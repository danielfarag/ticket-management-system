<?php
namespace App\Domain\General\Http\Requests\Todo;

use App\Domain\General\Repositories\Contracts\TodoRepository;

class TodoUpdateFormRequest extends TodoStoreFormRequest
{
    /**
     * Determine if the todo is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('todo'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'due_at'    =>  ['required', 'date'],
        ];

        return array_merge(parent::rules(), $rules);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return parent::attributes();
    }
}
