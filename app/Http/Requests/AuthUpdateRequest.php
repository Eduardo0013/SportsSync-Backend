<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'id' => 'required',
            'username' => 'required|max:255',
            'nombre' => 'required|max:255',
            'apellidoPaterno' => 'required|max:255',
            'apellidoMaterno' => 'required|max:255',
            'phoneNumber' => 'required|max:255',
            'fechaNacimiento' => 'required',
            'profilePhoto' => 'required|max:255',
            'ineAddress' => 'required',
            'password' => 'required',
            'email' => 'required|max:255'
        ];
    }
}
