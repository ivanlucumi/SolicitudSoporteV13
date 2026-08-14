<?php

namespace App\Exports;

use App\Models\BienestarFuncionario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsistenciaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Funcionario::with('acompanantes')->get()->map(function($funcionario) {
            return [
                'Funcionario' => $funcionario->nombre,
                'Cédula' => $funcionario->cedula,
                'Correo' => $funcionario->correo,
                'Teléfono' => $funcionario->telefono,
                'Cargo' => $funcionario->cargo,
                'Despacho' => $funcionario->despacho,
                'Acompañantes' => $funcionario->acompanantes->map(function($acompanante) {
                    return $acompanante->nombre . ' (' . $acompanante->parentezco . ')';
                })->implode(', '),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Funcionario',
            'Cédula',
            'Correo',
            'Teléfono',
            'Cargo',
            'Despacho',
            'Acompañantes'
        ];
    }
}