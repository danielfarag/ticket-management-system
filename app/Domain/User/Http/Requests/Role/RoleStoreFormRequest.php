<?php

namespace App\Domain\User\Http\Requests\Role;

use App\Domain\User\Entities\Role;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class RoleStoreFormRequest extends FormRequest implements RoleFormRequest
{
    /**
     * Determine if the Role is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions'   => ['required', 'array', 'min:1'],
            'permissions.*' => ['required', 'exists:permissions,name'],
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
            'name'         =>  __('main.name'),
            'permissions'  =>  __('main.permissions'),
        ];
    }

    /**
     * Get Validated attributes.
     *
     * @return array
     */
    public function validated()
    {
        return array_merge(parent::validated(), [
            'guard_name' => 'web'
        ]);
    }
}
