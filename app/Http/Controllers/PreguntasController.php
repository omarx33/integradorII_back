<?php

namespace App\Http\Controllers;

use App\Models\Preguntas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreguntasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');  /*  validar sesion */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

try {

    if ($request->ajax() ) {

        $result = Preguntas::select(DB::raw("

        *

        "))->get();



         return  array('data' => $result );

    }


     return view('preguntas.index');
} catch (\Throwable $th) {
    return $th->getMessage();
}


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ( $request->id ) {

        return $result = Preguntas::actualizacion($request->all());

        }else{
        return $result = Preguntas::registrar($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preguntas  $preguntas
     * @return \Illuminate\Http\Response
     */
    public function show(Preguntas $preguntas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preguntas  $preguntas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Preguntas::where('id',$id)->first();
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preguntas  $preguntas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preguntas $preguntas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preguntas  $preguntas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       Preguntas::where('id',$id)->delete();
      return array(
        'title' => "Buen trabajo",
        'text' => "Registro eliminado",
        'icon' => "delete"


     );
    }
}
