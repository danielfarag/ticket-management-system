<?php

namespace App\Domain\General\Http\Requests\Category;

use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Infrastructure\Http\AbstractRequests\BaseRequest as FormRequest;

class CategoryStoreFormRequest extends FormRequest implements CategoryFormRequest
{
    /**
     * Determine if the Category is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $class = app()->make(CategoryRepository::class)->getPolicyModel($this->get('type'));
        
        return $this->user()->can('manageCategories', $class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'          => ['required', 'string', 'max:255'],
            'status'        => ['required', 'in:active,inactive'],
            'type'          => ['required', 'in:faqs,articles,tickets'],
            'icon'          => ['required'],
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
            'name'      =>  __('main.name'),
            'status'    =>  __('main.status'),
            'type'      =>  __('main.type'),
            'icon'      =>  __('main.icon'),
        ];
    }
}
