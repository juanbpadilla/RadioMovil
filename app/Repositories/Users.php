<?php

namespace App\Repositories;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Cache;


Class Users
{
    public function getPaginated()
    {
        $key = "users.page." . request('page', 1);

        return Cache::tags('users')->rememberForever($key, function () {
            return User::with(['roles', 'note'])
                ->orderBy('created_at', request('sorted', 'DESC'))
                ->paginate(10);
        });
    }

    public function store($request)
    {
        $user = User::create( $request->all());

        $user->roles()->attach($request->roles);

        return Cache::tags('users')->flush();
    }

    public function findById($id)
    {
       return Cache::tags('users')->rememberForever("users.{$id}", function () use($id) {
                return User::findOrFail($id);
            });
    }

    public function pluckRoles($id){
        return Role::pluck('display_name', 'id');
    }


    public function update($request, $user)
    {
        $user->update($request->only('nombre','apellido','sexo','direccion','telefono','email', 'user_name' ));

        $user->roles()->sync($request->roles);

        Cache::tags('users')->flush();

        return $user;
    }

    public function destroy($user)
    {
        $user->roles()->detach();
        
        $user->delete();

        return Cache::tags('users')->flush();        
    }
}