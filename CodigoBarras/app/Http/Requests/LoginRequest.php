<?php

namespace App\Http\Requests;

use Psy\Exception\ThrowUpException;
use SebastianBergmann\Type\TrueType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cedula' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'cedula.required' => 'El campo cédula es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];
    }

    public function getCredentials(){
        $cedula = $this->get('cedula');
        $password = $this->get('password');

        return $this->only('cedula', 'password'); 
    }

}
