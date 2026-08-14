<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirectorioRequest extends FormRequest
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
            'dDespacho'  => 'required|max:80',
            'dCiudad'    => 'required|max:30',
            'dDireccion' => 'required|max:50',
            'dTelefono'  => 'required|max:50',
        ];
    }
}
