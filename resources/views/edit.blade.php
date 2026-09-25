@extends('layouts.app')

@section('title', 'Editar Cliente - MSA Automotriz')

@push('styles')
<style>
    .card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border: 1px solid #eaeaea;
        max-width: 800px;
        margin: 0 auto;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-header h2 {
        font-size: 16px;
        color: var(--primary-red);
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .input-group {
        flex: 1;
    }

    .input-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 13px;
        color: #555;
    }

    .input-group input, .input-group textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        background: #f9f9f9;
    }
    
    @media (max-width: 768px) {
        .form-row { flex-direction: column; gap: 15px; }
    }
</style>
@endpush

@section('content')
<div class="layout-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" alt="MSA Automotriz">
        </div>
        <ul class="nav-menu">
            <li class="nav-item"><a href="{{ route('dashboard') }}" style="color: inherit; text-decoration: none;">Registro de Clientes</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content-wrapper">
        <div class="card">
            <div class="card-header">
                <h2>Editar Cliente: {{ $client->name }}</h2>
            </div>
            
            @if ($errors->any())
                <div style="background-color: #fee; color: #E60000; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('clients.update', $client->id) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="input-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', $client->name) }}" required>
                    </div>
                    <div class="input-group">
                        <label>DNI</label>
                        <input type="text" name="dni" value="{{ old('dni', $client->dni) }}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label>Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $client->email) }}">
                    </div>
                    <div class="input-group">
                        <label>Teléfono</label>
                        <input type="tel" name="phone" value="{{ old('phone', $client->phone) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label>Comentarios</label>
                        <textarea name="comments" rows="3" style="resize: vertical;">{{ old('comments', $client->comments) }}</textarea>
                    </div>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <button type="submit" class="btn btn-red">Actualizar Cliente</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
