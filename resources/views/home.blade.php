@extends('layouts.ensayo1')
@section('title', 'SIRIS CALI | Panel')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
    <div class="glass-card p-8 rounded-2xl max-w-lg w-full" data-aos="fade-up">
        <div class="mb-6">
            <i class="bi bi-person-circle text-6xl text-primary"></i>
        </div>
        <h1 class="text-2xl font-bold text-primary mb-2">Bienvenido a SIRIS CALI</h1>
        <p class="text-slate-500 mb-6">Sistema de Registro de Requerimientos Informáticos – DISAJ Cali</p>
        
        <div class="flex flex-col gap-3">
            <a href="{!! url('/login') !!}" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl font-semibold transition-all shadow-lg shadow-primary/30">
                <i class="bi bi-box-arrow-in-right mr-2"></i> Iniciar Sesión
            </a>
            <a href="{!! url('/') !!}" class="bg-white hover:bg-slate-50 text-primary border border-primary/20 px-6 py-3 rounded-xl font-semibold transition-all">
                <i class="bi bi-house mr-2"></i> Volver al Inicio
            </a>
        </div>
    </div>
</div>
@endsection
