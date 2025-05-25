<?php

namespace App\Domain\User\Http\Requests\User;

use App\Domain\User\Entities\User;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class UserStoreFormRequest extends FormRequest implements UserFormRequest
{
    /**
     * Determine if the User is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required', 'min:3', 'max:255'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'phone_number'  => ['required', 'string', 'unique:users,phone_number'],
            'password'      => ['required', 'min:8', 'max:32', 'confirmed'],
            'status'        => ['required', 'in:active,inactive'],
            'type'          => ['required', 'in:admin,agent,user'],
            'role_id'       => ['nullable', 'exists:roles,id'],
        ];
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
            'email'        =>  __('main.email'),
            'phone_number' =>  __('main.phone_number'),
            'password'     =>  __('main.password'),
            'status'       =>  __('main.status'),
        ];
    }
}
