<?php

namespace App\Domain\General\Http\Requests\Todo;

use App\Domain\General\Entities\Todo;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;
use Carbon\Carbon;

class TodoStoreFormRequest extends FormRequest implements TodoFormRequest
{
    /**
     * Determine if the Todo is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Todo::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'subject'   =>  ['required', 'min:3', 'max:255'],
            'body'      =>  ['required', 'min:3', 'max:255'],
            'priority'  =>  ['required', 'in:low,high,medium'],
            'status'    =>  ['required', 'in:done,idle,todo,in_progress,urget'],
            'agent_id'  =>  ['nullable', 'exists:users,id'],
            'due_at'    =>  ['required', 'date', 'after:now'],
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
            'subject'     =>  __('main.subject'),
            'body'        =>  __('main.body'),
            'priority'    =>  __('main.priority'),
            'status'      =>  __('main.status'),
            'agent_id'    =>  __('main.user'),
            'due_at'      =>  __('main.due_at'),
        ];
    }

    /**
     * Get Validated attributes.
     *
     * @return array
     */
    public function validated()
    {
        $data = parent::validated();

        return array_merge(parent::validated(), [
            'agent_id'    =>  $data['agent_id'] ?? auth()->id(),
            'due_at'      =>  Carbon::parse($data['due_at']),
        ]);
    }
}