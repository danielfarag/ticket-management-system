<?php

namespace App\Domain\Ticket\Http\Requests\Department;

use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class DepartmentAgentsFormRequest extends FormRequest implements DepartmentFormRequest
{
    /**
     * Determine if the Department is authorized to make this request.
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
        $rules = [
            'agents'   => ['required', 'array'],
            'agents.*' => ['required', 'exists:users,id'],
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
