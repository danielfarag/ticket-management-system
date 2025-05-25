<?php

namespace App\Domain\Interaction\Http\Requests\Contact;

use App\Domain\Interaction\Entities\Contact;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class ContactStoreFormRequest extends FormRequest implements ContactFormRequest
{
    /**
     * Determine if the Contact is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Contact::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email'],
            'phone_number'      => ['required','min:8'],
            'message'           => ['required', 'min:10', 'max:255'],
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
            'name'          =>  __('main.name'),
            'email'         =>  __('main.email'),
            'phone_number'  =>  __('main.phone_number'),
            'message'       =>  __('main.message'),
        ];
    }
}
