<?php

namespace App\Domain\Ticket\Http\Requests\Status;

class StatusUpdateFormRequest extends StatusStoreFormRequest
{
    /**
     * Determine if the status is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('status'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255', 'unique:statuses,name,'.$this->route('status')->id.',id'],
            'priority'  => ['required', 'numeric', 'max:255', 'unique:statuses,priority,'.$this->route('status')->id.',id'],
            'color'     => ['required', 'string', 'unique:statuses,color,'.$this->route('status')->id.',id'],
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
