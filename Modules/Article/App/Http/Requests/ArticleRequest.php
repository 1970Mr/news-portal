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
            'description' => 'required|string',
            'keywords' => 'required|string',
            'body' => 'required|string',
            'published_at' => 'required|date',
            'editor_choice' => 'required|boolean',
            'status' => 'required|boolean',
            'image' => 'required' . $imageRules,
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|exists:tags,id',
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
        ]);
    }

    public function messages(): array
    {
        return [
            'body.required' => __('entity_required', ['entity' => __('news_text')])
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
