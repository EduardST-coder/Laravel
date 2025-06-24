<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:200|unique:blog_posts',
            'slug' => 'max:200|unique:blog_posts',
            'content_raw' => 'required|string|min:5|max:10000',
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Введіть заголовок статті',
            'title.min' => 'Заголовок має містити щонайменше :min символів',
            'title.max' => 'Заголовок не може перевищувати :max символів',
            'title.unique' => 'Такий заголовок вже існує',

            'slug.max' => 'Псевдонім не може перевищувати :max символів',
            'slug.unique' => 'Такий псевдонім вже використовується',

            'content_raw.required' => 'Введіть текст статті',
            'content_raw.min' => 'Текст має бути щонайменше :min символів',
            'content_raw.max' => 'Текст не може перевищувати :max символів',

            'category_id.required' => 'Оберіть категорію',
            'category_id.integer' => 'Категорія має бути числом',
            'category_id.exists' => 'Обрана категорія не існує',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'заголовок статті',
            'slug' => 'псевдонім',
            'content_raw' => 'текст статті',
            'category_id' => 'категорія',
        ];
    }
}
