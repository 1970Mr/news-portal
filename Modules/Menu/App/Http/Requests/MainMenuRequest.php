<?php

namespace Modules\Menu\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Menu\App\Models\Menu;

class MainMenuRequest extends FormRequest
{
    public function rules(): array
    {
        $types = [Menu::MAIN_TYPE, Menu::SUBMENU_TYPE];
        $rules = [
            'name' => 'required|min:2|max:100|unique:menus,name',
            'url' => 'required|url',
            'position' => 'required|numeric|unique:menus,position',
            'type' => 'nullable|in:' . implode(',', $types),
            'parent_id' => 'nullable|numeric|exists:menus,id',
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
            $rules['name'] .= ',' . $this->route('menu')->id;
            $rules['position'] .= ',' . $this->route('menu')->id;
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $fields = [
            'status' => (bool)$this->status,
        ];

        if ($this->parent_id) {
            $fields += [
                'type' => Menu::SUBMENU_TYPE
            ];
        }

        $this->merge($fields);
    }
}
