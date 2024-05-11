<?php

namespace Modules\User\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    private $user;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $this->route('user')->id,
            'description' => 'nullable|string|max:600',
            'password' => 'exclude_if:password,null|min:8|confirmed',
            'picture' => 'nullable|image|max:5000',
            'email_verification' => 'nullable',
            'status' => 'bool',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool) $this->status,
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
