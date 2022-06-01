<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Persona:alll() o getpide todas las personas
        ///api/persona?page=1&limit=10&orderby=nombres&q=rick
        //con request se puede enviar el limite desde vue
        // Persona::paginate($request->limit); P3-1:38
        $limite=$request->limit;
        $personas=Persona::orWhere('nombres','like','%'.$request->q.'%')
                ->orderBy($request->orderby)
                ->paginate($limite?$limite:10);
        return response()->json($personas,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validad //ver ip desde request
        $request->validate([
            "ci"=>"unique:personas|max:15",
            "nombres"=>"required|max:50",
            "apellidos"=>"required|max:50",
            //los demas son nullable
        ]);

        //guardar
        $persona= new Persona();
        $persona->ci=$request->ci;
        $persona->nombres=$request->nombres;
        $persona->apellidos=$request->apellidos;
        $persona->direccion=$request->direccion;
        $persona->save();
        //responder
        return response()->json([
            "Mensaje"=>"Se registro correctamente",
            "error"=>null,
            "status"=>true
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
