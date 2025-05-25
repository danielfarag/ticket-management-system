<?php

namespace App\Domain\Website\Http\Requests\Ticket;

use App\Domain\Ticket\Entities\Ticket;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class TicketSurveyStoreFormRequest extends FormRequest
{
    /**
     * Determine if the Ticket is authorized to make this request.
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
        $rules = [
            'resolved'       => ['required', 'in:yes,no'],
            'comment'        => ['nullable', 'min:3, max:255'],
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
            'resolved'  =>  __('main.resolved'),
            'comment'   =>  __('main.comment'),
        ];
    }
}
