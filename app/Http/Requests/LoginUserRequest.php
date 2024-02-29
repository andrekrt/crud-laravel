<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
        $userId=$this->route('usuario');

        return [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.($userId?$userId->id:null),
            'senha'=>'required_if:password,!=,null|min:6',
        ];
    }

    public function messages(): array
    {
        return[
            'name.required'=>'Campo nome do usuário é obrigatório!',
            'email.required'=>'Campo E-mail é obrigatório '  ,
            'email.email'=>'Digite um e-mail válido',
            'email.unique'=>'O e-mail já está cadastrado',
            'senha.required_if'=>'O campo senha é obrigatório ',
            'senha.min'=>'Senha precisa ter no mínimo :min caracteres'
        ];
    }
}
