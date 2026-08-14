<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResolveSolicitudServicioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Asumimos middleware de Admin
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'respuesta' => 'required|string|max:5000',
            
            // Validar que el admin también pueda subir múltiples anexos a su respuesta
            'anexos_respuesta'   => 'nullable|array|max:5',
            'anexos_respuesta.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp,zip|max:5120',
        ];
    }
    
    public function messages()
    {
        return [
            'respuesta.required' => 'Debe ingresar una respuesta o justificación para el usuario.',
            'anexos_respuesta.max' => 'No puedes adjuntar más de 5 archivos.',
            'anexos_respuesta.*.mimes' => 'Solo se permiten archivos en formato PDF, Word, Excel, JPG, PNG o ZIP.',
            'anexos_respuesta.*.max' => 'Cada archivo no debe superar los 5MB.',
        ];
    }
}
