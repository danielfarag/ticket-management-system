<?php

namespace App\Domain\Ticket\Http\Requests\Ticket;

use App\Domain\Ticket\Entities\Ticket;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class TicketUpdateColumnFormRequest extends FormRequest
{
    /**
     * Determine if the Ticket is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('ticket'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id'   => ['nullable', 'exists:categories,id'],
            'severity_id'   => ['nullable', 'exists:severities,id'],
            'status_id'     => ['nullable', 'exists:statuses,id'],
            'solved'        => ['nullable', 'in:yes,no'],
            'agents'        => ['nullable', 'array'],
            'agents.*'      => ['required', 'exists:users,id'],
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
            'category_id'        =>  __('main.category'),
        ];
    }
}
