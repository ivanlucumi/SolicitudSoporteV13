{{-- resources/views/admin/escalafon/import.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Importar Escalaf&oacute;n</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('despachos.import.escalafon') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Archivo Excel (.xlsx / .xls)</label>
            <input type="file" name="archivo" class="form-control" accept=".xlsx,.xls" required>
            @error('archivo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cargar y Procesar</button>
        <a href="{{ route('despachos.import.view.escalafon') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection


