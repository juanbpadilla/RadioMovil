@extends('layout')

@section('contenido')
    <h1>Mensaje de {{ $message->nombre }}</h1>
    <table class="table">
        <tr>
            <th>Id</th>
            <td>{{ $message->id }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $message->nombre }}</td>
        </tr>
        <tr>
            <th>Mensaje</th>
            <td>{{ $message->mensaje }}</td>
        </tr>
    </table>
@stop