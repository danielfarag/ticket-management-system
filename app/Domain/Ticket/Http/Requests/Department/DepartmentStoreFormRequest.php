<?php

namespace App\Domain\Ticket\Http\Requests\Department;

use App\Domain\Ticket\Entities\Department;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class DepartmentStoreFormRequest extends FormRequest implements DepartmentFormRequest
{
    /**
     * Determine if the Department is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Department::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'         => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string', 'max:255'],
            'status'       => ['required', 'in:active,inactive'],
            'image'        => ['required', 'image'],
            'categories'   => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
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
