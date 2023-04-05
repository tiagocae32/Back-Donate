<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationsException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRegisterRequest extends FormRequest
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
            'name' => ['required', 'unique:users,name', 'string','min:5', 'max:30'],
            'email' => ['required', 'unique:users,email', 'email', 'max:30'],
            'password' => ['required', 'string', 'min:9', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya ha sido registrado',
            'email.required' => 'El mail es obligatorio',
            'email.unique' => 'El mail ya ha sido registrado',
            'password.required' => 'La contraseña es obligatoria',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new ValidationsException($validator,400);
    }
}
