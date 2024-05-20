<?php

namespace Modules\Setting\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'footer_description' => 'required|string',
            'header_logo' => 'nullable|image|max:5000',
            'footer_logo' => 'nullable|image|max:5000',
        ];
    }

    public function attributes(): array
    {
        return [
            'footer_description' => __('footer_description'),
            'header_logo' => __('header_logo'),
            'footer_logo' => __('footer_logo'),
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
