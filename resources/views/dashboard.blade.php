@extends('layouts.app')

@section('title', 'Dashboard - MSA Automotriz')

@push('styles')
<style>
    .stats-row {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        flex: 1;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        border: 1px solid #eaeaea;
    }

    .stat-card.red-card {
        background: #ffebeb;
        border-color: #ffcccc;
    }

    .stat-card.red-card h3 { color: var(--primary-red); }

    .stat-card h3 {
        font-size: 32px;
        margin-bottom: 5px;
    }

    .stat-card p {
        color: #666;
        font-size: 13px;
        font-weight: 600;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border: 1px solid #eaeaea;
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

    .input-group input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        background: #f9f9f9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px 10px;
        text-align: left;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    th {
        color: #888;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Print styling */
    @media print {
        .sidebar, .add-client-card, .btn, .topbar {
            display: none !important;
        }
        .main-content-wrapper {
            margin-left: 0;
            padding: 0;
            background: white;
        }
        body { background: white; }
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .stats-row {
            flex-direction: column;
            gap: 15px;
        }
        .form-row {
            flex-direction: column;
            gap: 15px;
        }
        .card {
            padding: 15px;
        }
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .card-header div {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
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
            <li class="nav-item active">Registro de Clientes</li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content-wrapper">

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="stats-row">
            <div class="stat-card">
                <h3>{{ $clients->count() }}</h3>
                <p>Clientes Registrados</p>
            </div>
        </div>

        <div class="card add-client-card">
            <div class="card-header">
                <h2>Registrar Nuevo Cliente</h2>
            </div>
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <div class="form-row">
                    <div class="input-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="input-group">
                        <label>DNI</label>
                        <input type="text" name="dni" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label>Correo Electrónico</label>
                        <input type="email" name="email">
                    </div>
                    <div class="input-group">
                        <label>Teléfono</label>
                        <input type="tel" name="phone">
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label>Comentarios</label>
                        <textarea name="comments" rows="3" style="width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; background: #f9f9f9; resize: vertical;"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-red">Registrar Cliente</button>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Lista de Clientes</h2>
                <div>
                    <a href="{{ route('clients.export') }}" class="btn btn-outline" style="margin-right: 10px;">Descargar Excel</a>
                    <a href="{{ route('clients.export.pdf') }}" class="btn btn-dark">Descargar PDF</a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="clients-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Comentarios</th>
                            <th class="no-print">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        <tr>
                            <td><strong>{{ $client->name }}</strong></td>
                            <td>{{ $client->dni }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->comments }}</td>
                            <td class="no-print">
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <a href="{{ route('clients.edit', $client->id) }}" style="color: #0066cc; text-decoration: none; font-weight: bold; font-size: 13px;">Editar</a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" style="background: none; border: none; color: var(--primary-red); cursor: pointer; font-weight: bold; font-size: 13px;">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #999;">No hay clientes registrados aún.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
