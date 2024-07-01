<?php

namespace Modules\FileManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VideoRequest extends FormRequest
{
    public function rules(): array
    {
        $video_rule = 'file|mimes:mp4,mov,mkv,ogg,qt|max:20000';
        $rules = [
            'video' => "required|$video_rule",
            'thumbnail' => 'nullable|image|max:2048',
            'user_id' => 'required|numeric',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['video'] = "nullable|$video_rule";
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => Auth::id(),
        ]);
    }
}
