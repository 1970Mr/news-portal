<?php

namespace Modules\Article\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        $imageRules = '|image|max:5000';
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'description' => 'required|string|min:10',
            'keywords' => 'required|string',
            'body' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'required' . $imageRules,
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|exists:tags,id',
            'editor_choice' => 'required|boolean',
            'status' => 'required|boolean',
            'hotness' => 'required|bool',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['image'] = 'nullable' . $imageRules;
            $rules['slug'] .= ',' . $this->route('article')->id;
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'editor_choice' => (bool) $this->editor_choice,
            'status' => (bool) $this->status,
            'hotness' => (bool) $this->hotness,
        ]);
    }

    public function attributes(): array
    {
        return [
            'category_id' => __('category'),
            'hotness' => __('common::attributes.hotness'),
            'body' => __('common::attributes.news_text'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
