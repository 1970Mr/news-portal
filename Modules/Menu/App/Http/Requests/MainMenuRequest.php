<?php

namespace Modules\Menu\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Menu\App\Models\Menu;

class MainMenuRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => 'required|min:2|max:100|unique:menus,name',
            'url' => 'required|url',
            'position' => 'required|numeric|unique:menus,position',
            'parent_id' => 'nullable|numeric|exists:menus,id',
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['name'] .= ',' . $this->route('menu')->id;
            $rules['position'] .= ',' . $this->route('menu')->id;
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => (bool) $this->status,
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}