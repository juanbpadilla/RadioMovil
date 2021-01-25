@extends('layout')

@section('contenido')
    <h1>Crear nuevo usuario</h1>

    <form method="POST" action="{{ route('pasajeros.store') }}">
        
        @include('passangers.form', ['user' => new App\User])

        <input class="btn btn-primary" type="submit" value="Guardar">
    </form>
@stop