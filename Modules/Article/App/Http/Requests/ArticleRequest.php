<?php

namespace Modules\Article\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Article\App\Models\Article;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        $imageRules = '|image|max:5000';
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'body' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'required' . $imageRules,
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|exists:tags,id',
            'editor_choice' => 'required|boolean',
            'hotness' => 'required|bool',
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['image'] = 'nullable' . $imageRules;
            $rules['slug'] .= ',' . $this->route('article')->id;
        } else {
            $rules['type'] = 'required|in:' . implode(',', Article::TYPES);
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'category_id' => __('category'),
            'type' => __('article::attributes.type'),
            'hotness' => __('common::attributes.hotness'),
            'body' => __('common::attributes.news_text'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'editor_choice' => (bool)$this->editor_choice,
            'hotness' => (bool)$this->hotness,
            'status' => (bool)$this->status,
        ]);
    }
}
