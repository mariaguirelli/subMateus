<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;

class ProfissoesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    protected function failedValidation(Validator $validator)
    {
        {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'erros' => $validator->errors(),
            ], 422));
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $profissaoId = $this->route('profissao');

        return [
            'nome' => 'required',
            'descricao' => 'required',
            'salario' => 'required',
            'empresa' => 'required'
        ];
    }

    public function messages(): array 
    {
        return [
            'nome.required' => 'Campo nome é obrigatório!',
            'descricao.required' => 'Campo descrição é obrigatório!',
            'salario.required' => 'Campo salario é obrigatório!',
            'empresa.required' => 'Campo empresa é obrigatório!',
        ];
    }

}
