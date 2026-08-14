<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComiteGeneroGaleriaUpdateRequest extends FormRequest
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
            'cggTitulo'       => 'required|min:5|max:70',
            'cggImagen'       => 'max:3072',
            'cggdescripcion'  => 'max:200',
            'cggFecha'        => 'required|date',
            'cggEstado'       => 'required|min:1',
        ];
    }
}
