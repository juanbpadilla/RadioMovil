{!! csrf_field() !!}

<p><label for="nombre">
    Nombre
    <input class="form-control" type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}">
    {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="apellido">
    Apellido
    <input class="form-control" type="text" name="apellido" value="{{ old('apellido', $user->apellido) }}">
    {!! $errors->first('apellido', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="sexo">
    Sexo:
    <select class="form-control" name="sexo">
        <option value="">Sexo..</option>
        <option value="Hombre" {{ (old('sexo') == "Hombre" ? "selected" : "") }}>Hombre</option>
        <option value="Mujer" {{ (old('sexo') == 'Mujer' ? "selected" : "") }}>Mujer</option>
    </select>
    {!! $errors->first('sexo', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="direccion">
    Direccion
    <input class="form-control" type="text" name="direccion" value="{{ old('direccion', $user->direccion) }}">
    {!! $errors->first('direccion', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="telefono">
    Teléfono
    <input class="form-control" type="text" name="telefono" value="{{ old('telefono', $user->telefono) }}">
    {!! $errors->first('telefono', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="email">
    Email
    <input class="form-control" type="text" name="email" value="{{ old('email', $user->email) }}">
    {!! $errors->first('email', '<span class=error>:message</span>') !!}
</label></p>
<p><label for="user_name">
    Nombre de usuario
    <input class="form-control" type="text" name="user_name" value="{{ old('email', $user->user_name) }}">
    {!! $errors->first('user_name', '<span class=error>:message</span>') !!}
</label></p>

@unless($user->id)
    <p><label for="password">
        Password
        <input class="form-control" type="password" name="password">
        {!! $errors->first('password', '<span class=error>:message</span>') !!}
    </label></p>

    <p><label for="password_confirmation">
        Password Confirm
        <input class="form-control" type="password" name="password_confirmation">
        {!! $errors->first('password_confirmation', '<span class=error>:message</span>') !!}
    </label></p>    
@endunless
{{-- <div>    
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="4" name="roles" checked>Terminos y condiciones
        </label>
    </div>
</div>
{!! $errors->first('roles', '<span class=error>:message</span>') !!} --}}
<hr>
