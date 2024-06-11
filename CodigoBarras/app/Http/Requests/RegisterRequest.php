<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'cedula' => 'required|unique:users,cedula',
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
        
    }

    public function messages(): array
    {
        return [
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.unique' => 'La cédula ya ha sido registrada.',
            'nombres.required' => 'El campo nombre es obligatorio.',
            'apellidos.required' => 'El campo apellido es obligatorio.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El campo correo debe ser una dirección de email válida.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password_confirmation.required' => 'El campo de confirmación de contraseña es obligatorio.',
            'password_confirmation.same' => 'La confirmación de contraseña no coincide con la contraseña.',
        ];
    }
    
}
