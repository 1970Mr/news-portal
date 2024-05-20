<?php

namespace Modules\Newsletter\App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:newsletters,email',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
