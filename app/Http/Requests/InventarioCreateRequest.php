<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioCreateRequest extends FormRequest
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
            'codigoElemento'       => 'required',            
            'codigoJuzgado'        => 'required',
            'placaInventario'      => 'required|max:50',            
            'marca'                => 'required|max:50',
            'modelo'               => 'required|max:50',            
            'serial'               => 'required|max:50',
            'valorArticulo'        => 'required|numeric|min:11',            
            'fechaAsignacion'      => 'required|date',
            'estadoPlaca'          => 'required|max:20',            
            'observacionPlaca'     => 'required',
        ];
    }
}
