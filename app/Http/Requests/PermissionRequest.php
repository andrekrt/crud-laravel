<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $permission = $this->route('permission');

        return [
            'name'=>'required|unique:permissions,name,'.($permission?$permission->id:null),
            'title'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'=>'O título é obrigatório',
            'name.required'=>'O nome é obrigatório',
            'name.unique'=>'Esse nome já esta cadastrado'
        ];
    }
}
