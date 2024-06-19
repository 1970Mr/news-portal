<?php

namespace Modules\RedirectManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RedirectRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'source_url' => 'required|url|unique:redirects',
            'destination_url' => 'required|url|different:source_url',
            'status_code' => 'required|integer',
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['source_url'] .= ',' . $this->route('redirect')->id;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'source_url' => __('source_url'),
            'destination_url' => __('destination_url'),
            'status_code' => __('status_code'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool)$this->status,
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
