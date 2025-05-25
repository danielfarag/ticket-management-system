<?php

namespace App\Domain\General\Http\Requests\Comment;

use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class CommentStoreFormRequest extends FormRequest implements CommentFormRequest
{
    /**
     * Determine if the Comment is authorized to make this request.
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
            'comment'        => ['required', 'string', 'max:255'],
            'attachments'    => ['nullable', 'array'],
            'attachments.*'  => ['required', 'file', 'mimes:jpg,jpeg,bmp,png,pdf,docx'],    
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
            'comment'        =>  __('main.comment'),
            'attachments'    =>  __('main.attachments'),
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
            'user_id'=>auth()->id(),
        ]);
    }
}
