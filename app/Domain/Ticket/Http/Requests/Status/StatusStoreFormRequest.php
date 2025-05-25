<?php

namespace App\Domain\Ticket\Http\Requests\Status;

use App\Domain\Ticket\Entities\Status;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class StatusStoreFormRequest extends FormRequest implements StatusFormRequest
{
    /**
     * Determine if the Status is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Status::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255', 'unique:statuses,name'],
            'priority'  => ['required','numeric', 'unique:statuses,priority', 'max:255'],
            'color'     => ['required','string', 'unique:statuses,color'],
            'status'    => ['required','in:active,inactive'],
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
