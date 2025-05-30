<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    public function index()
    {
        $response = Http::withToken(session('token'))
        ->get(config('app.api_url').'/api/patients');
        
        $patients = $response->successful() ? $response->json() : [];
        
        return view('dashboard.nutriologo.pacientes', compact('patients'));
    }
}