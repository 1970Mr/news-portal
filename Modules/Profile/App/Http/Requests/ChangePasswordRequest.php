<?php

namespace Modules\Profile\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|min:8',
            'new_password' => 'required|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.required' => __('entity_required', ['entity' => __('new_password')]),
            'new_password.min' => __('The :attribute must be at least :min characters.', ['attribute' => __('new_password'), 'min' => 8]),
            'new_password.confirmed' => __('The new password confirmation does not match.'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
