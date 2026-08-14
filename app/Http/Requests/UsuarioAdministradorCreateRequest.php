<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioAdministradorCreateRequest extends FormRequest
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
            //
            'cedula'           => 'required|unique:users,cedula|max:20',
            'name'             => 'required|max:80',
            'email'            => 'required|email|unique:users,email|max:70',
            'password'         => 'required|max:100',
            'rol'              => 'required',            
        ];
    }
}
