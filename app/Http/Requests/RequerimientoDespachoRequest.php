<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequerimientoDespachoRequest extends FormRequest
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
        return
        [
			'despacho_id' => 'required',
			'nombre_despacho' => 'required',
			'email_despacho' => 'required',
			'tipo_solicitud' => 'required',
			'observaciones' => 'required',
			'fecha_solicitud' => 'required',
			'usuario_id' => 'required',
			'evidencia_fotografica' => 'required',
        ];
    }
}
