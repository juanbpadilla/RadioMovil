@extends('layout')

@section('contenido')
    <a class="nav-link" href="{{ route('mensajes.index') }}">◄ Volver</a><h1>Editando mensaje de {{ $message->nombre }}</h1>
    <form method="POST" action="{{ route('mensajes.update', $message->id) }}">
        {!! method_field('PUT') !!}

        @include('messages.form')

        <button class="btn btn-info" type="submit">Enviar</button>
    </form>
    <hr>
@stop