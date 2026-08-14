<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CiudadesCreateRequest extends FormRequest
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
            'codigoCiudad'   => 'required|numeric|min:11|unique:ciudades,codigoCiudad',
            'nombreCiudad'   => 'required|unique:ciudades,nombreCiudad|max:30',
        ];
    }
}
