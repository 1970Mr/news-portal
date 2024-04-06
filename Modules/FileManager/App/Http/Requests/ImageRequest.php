<?php

namespace Modules\FileManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $image_rule = 'image|max:5000';
        $rules = [
            'image' => "required|$image_rule",
            'alt_text' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
        if (strtolower($this->method()) === 'put') {
            $rules['image'] = "nullable|$image_rule";
        }
        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'alt_text' => $this->altText,
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
