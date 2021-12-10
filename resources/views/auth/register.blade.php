@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="correo" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>
            <div class="col-md-6">
                <input id="correo" type="correo" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo">
                @error('correo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="clave" class="col-md-4 col-form-label text-md-right">Contraseña</label>
            <div class="col-md-6">
                <input id="clave" type="password" class="form-control @error('clave') is-invalid @enderror" name="clave" required autocomplete="clave-nueva">
                @error('clave')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="clave-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>
            <div class="col-md-6">
                <input id="clave-confirm" type="password" class="form-control" name="clave_confirmation" required autocomplete="clave-nueva">
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary btn-block">
                    Registrarme
                </button>
            </div>
        </div>
    </form>
@endsection
