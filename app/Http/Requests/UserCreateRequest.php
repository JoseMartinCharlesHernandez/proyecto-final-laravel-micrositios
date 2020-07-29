<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class UserCreateRequest extends FormRequest
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
            'name'=>'required|max:200',
            'email' =>'required|email|unique:users',
            'password' =>'required|max:80',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
           'name.required' => 'el :attribute es obligatorio',
           'name.max:200' =>'el :attribute debe tener un maximo de 200 caracteres',
           'email.required' => 'el :attribute es obligatorio',
           'email.email' =>'el :attribute no es una dirección valida',
           'email.unique' =>' este :attribute no está disponible',
           'password.required'=>'la :attribute es obligatoria',
           'password.max:80'=>'la :attribute debe tener maximo 80 caracteres',
            'type.required' =>'debes seleccionar un :attribute'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre de usuario',
            'email' =>'correo electronico',
            'password'=>'cotraseña',
            'type' => 'tipo de usuario',
        ];
    }
}
