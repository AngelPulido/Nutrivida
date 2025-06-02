<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        $apiBase = config('app.api_url');
        $token   = session('token');

        $response = Http::withToken($token)->get("{$apiBase}/users");
        abort_unless($response->successful(), $response->status(), $response->json('mensaje'));

        // El endpoint te regresa un arreglo de usuarios, cada uno con:
        //   id, nombre, correo, rol, teléfono, edad, género, dirección, altura_cm, peso_kg, especialidad…
        return collect($response->json())->map(function ($u) {
            return [
                'id'            => $u['id']           ?? null,
                'nombre'        => $u['nombre']       ?? null,
                'correo'        => $u['correo']       ?? null,
                'rol'           => $u['rol']          ?? null,
                'telefono'      => $u['telefono']     ?? null,
                'edad'          => $u['edad']         ?? null,
                'genero'        => $u['genero']       ?? null,
                'direccion'     => $u['direccion']    ?? null,
                'altura_cm'     => $u['altura_cm']    ?? null,
                'peso_kg'       => $u['peso_kg']      ?? null,
                'especialidad'  => $u['especialidad'] ?? null,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Correo',
            'Rol',
            'Telefono',
            'Edad',
            'Genero',
            'Direccion',
            'Altura (cm)',
            'Peso (kg)',
            'Especialidad',
        ];
    }
}
