<?php

namespace Modules\Setting\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteDetailRequest extends FormRequest
{
    public function rules(): array
    {
        $imageRules = '|image|max:5000';
        $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
            'keywords' => 'required|string',
            'footer_text' => 'required|string',
            'main_logo' => 'required'.$imageRules,
            'second_logo' => 'required'.$imageRules,
            'favicon' => 'nullable|mimes:jpg,jpeg,png,bmp,gif,svg,ico|max:5000',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['main_logo'] = 'nullable'.$imageRules;
            $rules['second_logo'] = 'nullable'.$imageRules;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'keywords' => __('keywords'),
            'footer_text' => __('footer_text'),
            'main_logo' => __('main_logo'),
            'second_logo' => __('second_logo'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
