<?php

namespace Modules\Tag\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:2|max:100|unique:tags,name',
            'slug' => 'required|unique:tags,slug',
            'description' => 'required|min:10',
            'status' => 'required|boolean',
            'hotness' => 'required|bool',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['name'] .= ',' . $this->route('tag')->id;
            $rules['slug'] .= ',' . $this->route('tag')->id;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'hotness' => __('common::attributes.hotness'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool)$this->status,
            'hotness' => (bool)$this->hotness,
        ]);
    }
}
