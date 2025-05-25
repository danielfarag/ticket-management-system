<?php

namespace App\Domain\General\Http\Requests\Service;

use App\Domain\General\Entities\Service;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class ServiceStoreFormRequest extends FormRequest implements ServiceFormRequest
{
    /**
     * Determine if the Service is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Service::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'icon'          => ['required', 'string', 'max:255'],
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string', 'max:255'],
            'status'        => ['required', 'in:active,inactive'],
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
