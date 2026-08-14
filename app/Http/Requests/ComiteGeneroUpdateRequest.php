<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComiteGeneroUpdateRequest extends FormRequest
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
            'cgtitulo'      => 'required|min:5',
            'cgdocumento'   => 'min:1|max:5000|mimes:pdf',
            //'cgmodificador' => 'required|max:50',
        ];
    }
}
