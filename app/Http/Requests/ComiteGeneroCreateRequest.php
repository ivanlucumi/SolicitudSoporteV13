<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComiteGeneroCreateRequest extends FormRequest
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
            'cgtitulo'    => 'required|min:5',
            'cgdocumento' => 'required|min:1|max:5000|mimes:pdf',
            //'cgcreador'   => 'required|max:50',
        ];
    }
}
