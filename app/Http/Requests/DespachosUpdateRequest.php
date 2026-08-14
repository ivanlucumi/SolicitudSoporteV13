<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DespachosUpdateRequest extends FormRequest
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
            'nombreDespacho'    => 'required|string|max:95',
            'sede'              => 'nullable|string|max:100',
            'codCiudad'         => 'required|string|max:20',
            'direccion'         => 'required|string|max:50',
            'telefono'          => 'required|numeric|digits_between:7,12',
            'correoD'           => 'required|email|max:70',
            'correo_demanda'    => 'nullable|email|max:70',
            'correo_memoriales' => 'nullable|email|max:70',
            'extension'         => 'nullable|string|max:20',
            'circuito'          => 'nullable|string|max:50',
            'districto'         => 'nullable|string|max:50',
            'edificio'          => 'nullable|string|max:50',
            'piso'              => 'nullable|string|max:20',
            'estado'            => 'nullable|string|in:Activo,Inactivo',
        ];
    }
}
