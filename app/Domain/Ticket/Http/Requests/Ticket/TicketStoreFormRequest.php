<?php

namespace App\Domain\Ticket\Http\Requests\Ticket;

use App\Domain\Ticket\Entities\Ticket;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class TicketStoreFormRequest extends FormRequest implements TicketFormRequest
{
    /**
     * Determine if the Ticket is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Ticket::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'subject'           => ['required', 'string', 'min:10', 'max:255'],
            'body'              => ['required', 'string', 'min:10'],
            'user_id'           => ['required', 'exists:users,id'],
            'severity_id'       => ['required', 'exists:severities,id'],
            'category_id'       => ['required', 'exists:categories,id'],
            'status_id'         => ['required', 'exists:statuses,id'],
            'solved'            => ['required', 'in:yes,no'],
            'attachments'       => ['nullable', 'array'],
            'attachments.*'     => ['required', 'file', 'mimes:jpg,jpeg,bmp,png,pdf,docx'],
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
            'subject'         =>  __('main.subject'),
            'body'            =>  __('main.body'),
            'user_id'         =>  __('main.user'),
            'severity_id'     =>  __('main.severity'),
            'category_id'     =>  __('main.category'),
            'status_id'       =>  __('main.status_id'),
            'solved'          =>  __('main.solved'),
            'attachments'     =>  __('main.attachments'),
        ];
    }
}
