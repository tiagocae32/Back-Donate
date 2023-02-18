<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','unique:users','string','max:30'],
            'email' => ['required','unique:users','email','max:30'],
            'password' => ['required','string','max:20'],
        ];
    }

    public function messages()
    {
    return [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El mail es obligatorio',
        'email.unique' => 'El mail ya ha sido registrado',
        'password.required' => 'La contraseña es obligatoria'
    ];
    }
}
