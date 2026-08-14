<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiasCreateRequest extends FormRequest
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
            'nNombre'   => 'required|max:100',
            'nImagen'   => 'required|max:300',
            'nEstado'   => 'required|max:20',
            'nCreador'  => 'required|max:50',
        ];
    }
}
