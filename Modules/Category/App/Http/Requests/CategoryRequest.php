<?php

namespace Modules\Category\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $imageRules = '|image|max:5000';
        $rules = [
            'name' => 'required|min:2|max:100|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'nullable|numeric',
            'image' => 'required'.$imageRules,
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['name'] .= ','.$this->route('category')->id;
            $rules['slug'] .= ','.$this->route('category')->id;
            $rules['image'] = 'nullable'.$imageRules;
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
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
