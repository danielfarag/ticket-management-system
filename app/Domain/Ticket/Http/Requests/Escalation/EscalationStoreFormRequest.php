<?php

namespace App\Domain\Ticket\Http\Requests\Escalation;

use App\Domain\Ticket\Entities\Escalation;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class EscalationStoreFormRequest extends FormRequest implements EscalationFormRequest
{
    /**
     * Determine if the Escalation is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Escalation::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'ticket_id'    => ['required', 'exists:tickets,id'],
            'body'         => ['required', 'string', 'min:10'],
            'status'       => ['required', 'in:pending,in_progress,solved'],
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

    /**
     * Get validated attributes.
     *
     * @return array
     */
    public function validated()
    {
        return array_merge(parent::validated(),[
            'creator_id'    => auth()->id(),
        ]);
    }
}
