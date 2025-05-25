<?php

namespace App\Domain\Ticket\Http\Requests\Severity;

use App\Domain\Ticket\Entities\Severity;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class SeverityStoreFormRequest extends FormRequest implements SeverityFormRequest
{
    /**
     * Determine if the Severity is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Severity::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255', 'unique:severities,name'],
            'priority'  => ['required', 'numeric', 'max:255', 'unique:severities,priority'],
            'color'     => ['required', 'string', 'unique:severities,color'],
            'status'    => ['required', 'in:active,inactive'],
        ];
        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'        =>  __('main.name'),
        ];
    }
}
