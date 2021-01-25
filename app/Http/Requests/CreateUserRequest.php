<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'sexo' => 'required', 
            'direccion' => 'required', 
            'telefono' => 'required', 
            'email' => 'email|required|unique:users,email',
            'user_name' => 'required|unique:users,user_name', 
            'password' => 'required|confirmed', // 'campo' 'campo_confirmation'
            'roles' => 'required',
        ];
    }
}
