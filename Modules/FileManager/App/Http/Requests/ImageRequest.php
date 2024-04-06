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
        return [
            'image' => 'required|image|max:5000',
            'alt_text' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->replace([
            'alt_text' => 'altText',
        ]);

        $this->merge([
            'status' => (bool) $this->status,
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
