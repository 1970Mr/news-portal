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

    public function attributes(): array
    {
        return [
            'new_password' => __('common::attributes.new_password'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
