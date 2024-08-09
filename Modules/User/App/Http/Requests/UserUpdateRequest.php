<?php

namespace Modules\User\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:2',
            'username' => 'required|string|min:2|unique:users,username,'.$this->route('user')->id,
            'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
            'bio' => 'nullable|string|max:600',
            'password' => 'exclude_if:password,null|min:8|confirmed',
            'picture' => 'nullable|image|max:5000',
            'email_verification' => 'nullable',
            'status' => 'bool',
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => __('full_name'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool) $this->status,
        ]);
    }
}
