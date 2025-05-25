<?php

namespace App\Domain\User\Http\Requests\Auth;

use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class UserRegisterFormRequest extends FormRequest
{
    /**
     * Determine if the User is authorized to make this request.
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
            'name'          => ['required', 'min:3', 'max:255'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'phone_number'  => ['required', 'unique:users,phone_number'],
            'password'      => ['required', 'min:8', 'max:32', 'confirmed'],
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

    /**
     * Return validated attributes
     *
     * @return array
     */
    public function validated()
    {
        return array_merge(parent::validated(),[
            'status'    =>  'active',
        ]);
    }
}
