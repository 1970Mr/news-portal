<?php

namespace Modules\Comment\App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        if (!Auth::check()) {
            $guest_rules = [
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|string|email|max:255',
            ];
        }

        $rules = [
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|string|min:1',
            'comment' => 'required|string'
        ];

        return array_merge($guest_rules ?? [], $rules);
    }

    public function attributes(): array
    {
        return [
            'guest_name' => 'نام کاربر',
            'guest_email' => 'ایمیل کاربر',
            'commentable_type' => 'مدل',
            'commentable_id' => 'id مدل',
            'comment' => 'دیدگاه کاربر',
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
