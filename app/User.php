<?php

namespace App;

use App\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'sexo', 
        'direccion', 
        'telefono', 
        'email', 
        'user_name',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRoles(array $roles)
    {        
        return $this->roles->pluck('name')->intersect($roles)->count();
    }  

    public function isAdmin()
    {
        return $this->hasRoles(['admin']);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'notable');
    }

    public function present()
    {
        return new UserPresenter($this);
    }
}
