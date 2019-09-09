<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
  use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'password','activo'
    ];

       protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

       public function setPasswordAttribute($password)
    {
           
            $this->attributes['password']= bcrypt($password);
    }

   public function persona()
    {
       
       return $this->belongsTo('App\Persona','user');

    }
    
}
