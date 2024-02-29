<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AulaRequest extends FormRequest
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
        return [
            'name'=>'required',
            'descricao'=>'required',
            'cursoId'=>'required'
        ];
    }

    public function messages(): array
    {
        return[
            'name.required'=>'Campo nome da aula é obrigatório!',
            'descricao.required'=>'Campo descrição da aula é obrigatório',
            'cursoId.required'=>'O curso de qual essa aula pertence é obrigatorio'
        ];
    }
}
