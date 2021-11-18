<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'empresa',
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public static function actualizacion($parametros){

        $parametros = (object)$parametros;



        User::where('id',$parametros->id)
        ->update([
            'nombre' => $parametros->nombre,
            'apellido' => $parametros->apellidos,
            'empresa' => $parametros->empresa,
            'email' => $parametros->correo

        ]);

          return [
        'title' => 'Buen trabajo',
        'text' => 'actualizado',
        'icon' => 'success'

    ];
    }



}
