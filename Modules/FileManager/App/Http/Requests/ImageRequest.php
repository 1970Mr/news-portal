<?php

namespace Modules\FileManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function rules(): array
    {
        $image_rule = 'image|max:5000';
        $rules = [
            'image' => "required|$image_rule",
            'alt_text' => 'nullable|string|max:255',
        ];
        if (strtolower($this->method()) === 'put') {
            $rules['image'] = "nullable|$image_rule";
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'alt_text' => __('common::attributes.alt_text'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'alt_text' => $this->altText,
        ]);
    }
}
