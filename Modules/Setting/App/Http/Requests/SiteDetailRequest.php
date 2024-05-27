<?php

namespace Modules\Setting\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteDetailRequest extends FormRequest
{
    public function rules(): array
    {
        $imageRules = '|image|max:5000';
        $rules = [
            'description' => 'required|string',
            'main_logo' => 'required' . $imageRules,
            'second_logo' => 'required' . $imageRules,
            'favicon' => 'nullable' . $imageRules,
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['main_logo'] = 'nullable' . $imageRules;
            $rules['second_logo'] = 'nullable' . $imageRules;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'footer_description' => __('footer_description'),
            'header_logo' => __('header_logo'),
            'footer_logo' => __('footer_logo'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
