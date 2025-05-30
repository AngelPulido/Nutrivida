<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class NutritionPlanController extends Controller
{
    public function index()
    {
        $response = Http::withToken(session('token'))
            ->get(config('app.api_url').'/api/nutrition-plans');
            
        $plans = $response->successful() ? $response->json() : [];
        
        return view('dashboard.nutriologo.planes', compact('plans'));
    }

    public function create()
    {
        $patients = Http::withToken(session('token'))
            ->get(config('app.api_url').'/api/patients')
            ->json();
            
        return view('nutriologo.planes.create', compact('patients'));
    }

    public function store()
    {
        $response = Http::withToken(session('token'))
            ->post(config('app.api_url').'/api/nutrition-plans', request()->all());
            
        if ($response->successful()) {
            return redirect()->route('nutriologo.planes.index')
                ->with('success', 'Plan creado exitosamente');
        }
        
        return back()->withInput()->with('error', 'Error al crear plan');
    }

    public function show($id)
    {
        $response = Http::withToken(session('token'))
            ->get(config('app.api_url')."/api/nutrition-plans/{$id}");
            
        $plan = $response->successful() ? $response->json() : null;
        
        return view('nutriologo.planes.show', compact('plan'));
    }

    public function edit($id)
    {
        $response = Http::withToken(session('token'))
            ->get(config('app.api_url')."/api/nutrition-plans/{$id}");
            
        $plan = $response->successful() ? $response->json() : null;
        
        $patients = Http::withToken(session('token'))
            ->get(config('app.api_url').'/api/patients')
            ->json();
            
        return view('nutriologo.planes.edit', compact('plan', 'patients'));
    }

    public function update($id)
    {
        $response = Http::withToken(session('token'))
            ->put(config('app.api_url')."/api/nutrition-plans/{$id}", request()->all());
            
        if ($response->successful()) {
            return redirect()->route('nutriologo.planes.show', $id)
                ->with('success', 'Plan actualizado exitosamente');
        }
        
        return back()->withInput()->with('error', 'Error al actualizar plan');
    }
}