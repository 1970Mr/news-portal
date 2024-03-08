<?php

namespace Modules\User\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\App\Models\User;

class UserUpdateRequest extends FormRequest
{
    private $user;
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = decrypt($this->request->get('id'));
        $this->user = User::find($id);
        return [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'exclude_if:password,null|min:8|confirmed',
            'email_verification' => 'nullable',
            'id' => 'required'
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
