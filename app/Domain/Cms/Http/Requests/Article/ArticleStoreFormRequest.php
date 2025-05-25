<?php

namespace App\Domain\Cms\Http\Requests\Article;

use App\Domain\Cms\Entities\Article;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class ArticleStoreFormRequest extends FormRequest implements ArticleFormRequest 
{
    /**
     * Determine if the Article is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Article::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title'        => ['required','max:255'],
            'body'         => ['required','min:10'],
            'category_id'  => ['required','exists:categories,id'],
            'status'       => ['required','in:active,inactive'],
            'image'        => ['required', 'image']
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
            'title'        =>  __('main.title'),
            'body'         =>  __('main.body'),
            'category_id'  =>  __('main.category'),
            'status'       =>  __('main.status'),
            'image'        =>  __('main.image'),
        ];
    }
}
