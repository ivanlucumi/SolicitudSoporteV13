<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaSalaCreateRequest extends FormRequest
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
        'rs_numero_radicado'        => 'required|numeric|digits_between:23,24', 
        'rs_sala'                   => 'required', 
        'rs_nombre_fiscal'          => 'required',
        'rs_fecha'                  => 'required|date',
        'rs_hora_inicio'            => 'required|date_format:H:i',
        'rs_hora_fin'               => 'required|date_format:H:i|after:rs_hora_inicio',
        'rs_estado'                 => 'required',
        ];
    }
}
