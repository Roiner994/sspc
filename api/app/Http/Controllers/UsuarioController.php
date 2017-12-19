<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Routing\Route;

class UsuarioController extends Controller
{
    
    public function __construct(){
        $this->middleware('cors');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios= Usuario::all();
        return response()->json($usuarios->toArray());
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
        Usuario::create([
                    'nombre' => $request ['nombre'],
                    'apellido' => $request ['apellido'],
                    'cedula' => $request ['cedula'],
                    'email' => $request ['email'],
                    'password' => bcrypt($request ['password']),
                    'tipo' => $request['tipo']
                ]);
        return response()->json(["mensaje"=>"usuario creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario= Usuario::find($id);
        return response()->json(["mensaje" => "success",
                                "usuario" => $usuario
                                ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $usuario = Usuario::FindOrFail($id);
        $input = $request->all();
        $usuario->fill($input)->save();
        return response()->json(['mensaje'=>'Usuario actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::FindOrFail($id);
        $usuario->delete();
        return response()->json(['mensaje'=>'Usuario eliminado correctamente']);
    }
}
