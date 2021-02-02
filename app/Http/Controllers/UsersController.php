<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    function __construct()
    {
        $this->middleware('auth', ['except' => ['show, create']]);
        $this->middleware('roles:admin', ['except' => ['edit', 'update','show', 'index', 'destroy', 'create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles', 'note'])->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id');
        
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        
        $user = User::create( $request->all());

        $user->roles()->attach($request->roles);

        return Redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->authorize($user);

        $roles = Role::pluck('display_name', 'id');
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $this->authorize($user);

        $user->update($request->only('nombre','apellido','sexo','direccion','telefono','email', 'user_name' ));

        $user->roles()->sync($request->roles);
        
        return back()->with('info', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // $this->authorize($user);

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('usuarios.index');
    }
}
