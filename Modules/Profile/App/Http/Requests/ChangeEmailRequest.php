<?php

namespace Modules\Profile\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
