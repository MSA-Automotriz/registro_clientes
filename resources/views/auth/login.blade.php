@extends('layouts.app')

@section('title', 'Login - MSA Automotriz')
@section('body_class', 'auth-body')

@push('styles')
<style>
    .login-box {
        background: var(--light-bg);
        padding: 40px 30px;
        border-radius: 12px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.6);
        border-top: 6px solid var(--primary-red);
        text-align: center;
    }

    .login-logo {
        max-width: 160px;
        margin-bottom: 5px;
    }

    .subtitle {
        color: #666;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .input-group {
        margin-bottom: 18px;
        text-align: left;
    }

    .input-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 700;
        font-size: 13px;
        color: #333;
    }

    .input-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 15px;
        background: #fdfdfd;
        color: #111;
        transition: border-color 0.2s;
    }

    .input-group input:focus {
        outline: none;
        border-color: var(--primary-red);
        box-shadow: 0 0 0 3px rgba(230, 0, 0, 0.1);
        background: #fff;
    }

    .btn-login {
        width: 100%;
        padding: 14px;
        font-size: 16px;
        border-radius: 8px;
        margin-top: 10px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .error-box {
        background-color: #fee;
        color: var(--primary-red);
        padding: 12px;
        border-radius: 6px;
        font-size: 13px;
        margin-bottom: 20px;
        border-left: 4px solid var(--primary-red);
        text-align: left;
    }

    @media (max-width: 480px) {
        .login-box {
            padding: 30px 20px;
            margin: 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="login-box">
    <img src="{{ asset('images/logo.png') }}" alt="MSA Automotriz" class="login-logo">
    <p class="subtitle">Ingresa para gestionar tus clientes</p>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="input-group">
            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" value="{{ old('dni') }}" required autofocus>
        </div>
        
        <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        
        <button type="submit" class="btn btn-red btn-login">Ingresar</button>
    </form>
</div>
@endsection
