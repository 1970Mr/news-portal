<?php

namespace Modules\Menu\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Menu\App\Models\Menu;

class CategoryMenuRequest extends FormRequest
{
    public function rules(): array
    {
        $types = [Menu::TYPE_CATEGORY, Menu::TYPE_PARENT_CATEGORY];
        $rules = [
            'position' => 'required|numeric|unique:menus,position',
            'type' => 'required|in:' . implode(',', $types),
            'category_id' => 'required|numeric|exists:categories,id',
            'status' => 'required|boolean',
        ];

        if (strtolower($this->method()) === 'put') {
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

    public function attributes(): array
    {
        return [
            'category_id' => __('category'),
            'position' => __('position'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
