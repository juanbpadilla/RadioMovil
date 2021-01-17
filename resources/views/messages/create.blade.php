@extends('layout')

@section('contenido')
    <h1>Contáctame</h1>

    @if( session()->has('info') )
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @else
    <form method="POST" action="{{ route('mensajes.store') }}">
        
        @include('messages.form', ['message' => new App\Message])

        <button class="btn btn-info" type="submit">Enviar</button>
    </form>
    @endif
    <hr>
@stop