<?php

namespace Modules\Article\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:articles,slug|max:255',
            'description' => 'required|string',
            'keywords' => 'required|string',
            'body' => 'required|string',
            'published_at' => 'required|date',
            'status' => 'required|boolean',
            'featured_image' => 'required|image|max:5000',
            'category_id' => 'required|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|exists:tags,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
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
