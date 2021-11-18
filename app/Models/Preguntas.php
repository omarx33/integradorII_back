<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    use HasFactory;

    protected $fillable = ['pregunta','respuesta'];

   public static function registrar($parametros){

    $parametros = (object)$parametros;//convertirlo en objeto

    Preguntas::create([
     'pregunta' => $parametros->pregunta,
     'respuesta' => $parametros->respuesta

    ]);


    return [
        'title' => 'Buen trabajo',
        'text' => 'se registro',
        'icon' => 'success'

    ];


   }



   public static function actualizacion($parametros){

    $parametros = (object)$parametros;



    Preguntas::where('id',$parametros->id)
    ->update([
        'pregunta' => $parametros->pregunta,
     'respuesta' => $parametros->respuesta

    ]);

      return [
    'title' => 'Buen trabajo',
    'text' => 'actualizado',
    'icon' => 'success'

];
}


}
