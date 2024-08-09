<?php

namespace Modules\PageBuilder\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageBuilderRequest extends FormRequest
{
    public function rules(): array
    {
        $imageRules = '|image|max:5000';
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'content' => 'required|string',
            'image' => 'required'.$imageRules,
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['image'] = 'nullable'.$imageRules;
            $rules['slug'] .= ','.$this->route('page')->id;
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool) $this->status,
        ]);
    }
}
