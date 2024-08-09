<?php

namespace Modules\AdManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AdManager\App\Models\Ad;

class AdRequest extends FormRequest
{
    public function rules(): array
    {
        $sectionNumbers = implode(',', array_keys(Ad::SECTIONS));
        $imageRules = '|image|max:5000';
        $rules = [
            'title' => 'required|string',
            'image' => 'required'.$imageRules,
            'link' => 'required|url',
            'section' => 'nullable|integer|in:'.$sectionNumbers,
            'published_at' => 'required|date',
            'expired_at' => 'nullable|date|after:published_at',
            'status' => 'nullable|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['image'] = 'nullable'.$imageRules;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'link' => __('link'),
            'section' => __('section'),
            'published_at' => __('published_at'),
            'expired_at' => __('expired_at'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool) $this->status,
            'expired_at' => $this->expired_at ?? null,
        ]);
    }
}
