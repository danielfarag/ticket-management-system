<?php

namespace App\Domain\Ticket\Http\Requests\Note;

use App\Domain\Ticket\Entities\Note;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class NoteStoreFormRequest extends FormRequest implements NoteFormRequest
{
    /**
     * Determine if the Note is authorized to make this request.
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
            'note'        => ['required', 'string', 'min:5', 'max:255'],
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
     * Get validated attribute.
     *
     * @return array
     */
    public function validated()
    {
        return array_merge(parent::validated(),[
            'agent_id'  => auth()->id()
        ]);
    }
}
