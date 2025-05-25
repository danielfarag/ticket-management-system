<?php

namespace App\Domain\Ticket\Http\Requests\Severity;

class SeverityUpdateFormRequest extends SeverityStoreFormRequest
{
    /**
     * Determine if the severity is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('severity'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255', 'unique:severities,name,'.$this->route('severity')->id.',id'],
            'priority'  => ['required', 'numeric', 'max:255', 'unique:severities,priority,'.$this->route('severity')->id.',id'],
            'color'     => ['required', 'string', 'unique:severities,color,'.$this->route('severity')->id.',id'],
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
