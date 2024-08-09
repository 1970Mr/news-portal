<?php

namespace Modules\Profile\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:2',
            'username' => 'required|string|min:2|unique:users,username,'.Auth::id(),
            'bio' => 'nullable|string|max:600',
            'picture' => 'nullable|image|max:5000',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
