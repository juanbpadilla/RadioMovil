<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('role_user')->truncate();

        $user = User::create([
            'nombre' => 'Dimar',
            'apellido' => 'Coca',
            'sexo' => 'Hombre',
            'direccion' => 'Barrio Guadalupe',
            'telefono' => '777777',
            'email' => 'dimar@email.com',
            'user_name' => 'simar1',
            'password' => '123123',
        ]);

        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Administrador del sitio web'
        ]);

        $user->roles()->save($role);
    }
}
