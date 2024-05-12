<?php

namespace Modules\User\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:2',
            'username' => 'required|string|min:2|unique:users',
            'email' => 'required|email|unique:users',
            'description' => 'nullable|string|max:600',
            'password' => 'required|min:8|confirmed',
            'picture' => 'required|image|max:5000',
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
}
