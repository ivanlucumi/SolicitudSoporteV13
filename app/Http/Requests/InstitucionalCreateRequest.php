<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitucionalCreateRequest extends FormRequest
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
            'iFoto'          => 'required|max:70',
            'iDescripcion'   => 'required',
            'iTipo'          => 'required|max:100',
            'iCreador'       => 'required|max:50',
        ];
    }
}
