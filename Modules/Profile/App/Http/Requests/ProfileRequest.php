<?php

namespace Modules\Profile\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string|max:600',
            'picture' => 'nullable|image|max:5000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
