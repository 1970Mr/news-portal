<?php

namespace Modules\Role\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|unique:roles,name',
            'local_name' => 'nullable|unique:roles,local_name',
            'permissions' => 'nullable',
        ];
        if ($this->method() === 'PUT') {
            $rules['name'] .= ',' . $this->route('role')->id;
            $rules['local_name'] .= ',' . $this->route('role')->id;
        }
        return $rules;
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
        $localName = $this->input('localName') ?? __($this->input('name'));
        $this->merge([
            'local_name' => $localName,
        ]);
    }
}
