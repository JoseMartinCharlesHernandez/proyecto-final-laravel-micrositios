<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MicrositioCreateRequest extends FormRequest
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
            'nombre'=>'required|max:255',
            'direccion' =>'required',
            'descripcion' =>'required|max:255',
            'estado' => 'required',
            'municipio' =>'required',
        ];
    }

    public function messages()
    {
        return [
           'nombre.required' => 'el :attribute es obligatorio',
           'nombre.max:255' =>'el :attribute debe tener maximo de 255 caracteres',
           'direccion.required' => 'el :attribute es obligatorio',
           'descripcion.unique' =>' este :attribute no está disponible',
           'password.required'=>'la :attribute es obligatoria',
           'password.max:80'=>'la :attribute debe tener maximo 80 caracteres',
            'type.required' =>'debes seleccionar un :attribute'
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'nombre de usuario',
            'direccion' =>'correo electronico',
            'descripcion'=>'cotraseña',
            'estado' => 'tipo de usuario',
            'municipio' =>'imagen',
        ];
    }
}
