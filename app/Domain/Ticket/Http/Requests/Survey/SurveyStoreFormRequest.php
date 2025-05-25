<?php

namespace App\Domain\Ticket\Http\Requests\Survey;

use App\Domain\Ticket\Entities\Survey;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class SurveyStoreFormRequest extends FormRequest implements SurveyFormRequest
{
    /**
     * Determine if the Survey is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Survey::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'ticket_id' => ['required', 'exist:tickets,id'],
            'resolved'  => ['required', 'in:yes,no'],
            'comment'   => ['nullable', 'string', 'max:255'],
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
