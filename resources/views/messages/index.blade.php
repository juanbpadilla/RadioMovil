@extends('layout')

@section('contenido')
    <h1>Mensajes</h1>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Mensaje</th>
            <th>Notas</th>
            @if (auth()->user()->hasRoles(['admin', 'mod']) )
                <th>Acciones</th>
            @endif
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    @if ($message->user_id)
                        <td>
                            <a href="{{ route('usuarios.show', $message->user_id) }}">
                                {{ $message->user->nombre }}
                            </a>
                        </td>
                        <td>{{ $message->user->email }}</td>
                    @else
                        <td>{{ $message->nombre }}</td>
                        <td>{{ $message->email }}</td>
                    @endif
                    <td>
                        <a href="{{ route('mensajes.show', $message->id) }}">{{ $message->mensaje }}</a>
                    </td>
                    <td>
                        {{ $message->note ? $message->note->body : '' }}
                    </td>
                    @if (auth()->user()->hasRoles(['admin', 'mod']) )
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('mensajes.edit', $message->id) }}">Editar</a>

                            <form style="display: inline" method="POST" action="{{ route('mensajes.destroy', $message->id) }}">
                                {!! method_field('DELETE') !!}
                                {!! csrf_field() !!}
                                <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                            </form>

                        </td>
                    @endif
                </tr>
            @endforeach
            {!! $messages->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </tbody>
    </table>
@stop