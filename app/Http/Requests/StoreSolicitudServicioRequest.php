<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolicitudServicioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Asumimos que la autenticación ya está validada por middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_funcionario' => 'required|string|max:50',
            'funcionario'    => 'required|string|max:255',
            'tipo_solicitud' => 'required|string|max:255',
            'solicitud'      => 'required|string|max:5000',
            
            // Validar que se puedan subir múltiples anexos si es array
            'anexos'   => 'nullable|array|max:5', // máximo 5 archivos
            // Validar cada anexo individualmente
            // mime: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, zip, etc. max: 5120 = 5MB
            'anexos.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp,zip|max:5120',
            
            'acta_nombramiento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }
    
    public function messages()
    {
        return [
            'anexos.max' => 'No puedes adjuntar más de 5 archivos.',
            'anexos.*.mimes' => 'Solo se permiten archivos en formato PDF, Word, Excel, JPG, PNG o ZIP.',
            'anexos.*.max' => 'Cada archivo no debe superar los 5MB.',
            'acta_nombramiento.mimes' => 'El acta debe ser PDF o imagen.',
            'acta_nombramiento.max' => 'El acta no debe superar los 5MB.',
        ];
    }
}
