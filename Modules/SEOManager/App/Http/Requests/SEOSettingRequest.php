<?php

namespace Modules\SEOManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SEOSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_author' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url',
            'robots' => 'nullable|string|max:255',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
