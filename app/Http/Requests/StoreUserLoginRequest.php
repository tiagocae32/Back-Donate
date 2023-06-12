<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationsException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreUserLoginRequest extends FormRequest
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
            'name_or_email' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El name es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
        ];
    }

    protected function failedValidation(Validator $validator){
        throw new ValidationsException($validator,400);
    }

}
