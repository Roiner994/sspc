<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;
use App\Models\Usuario;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('cors');
    }

    public function index()
    {
        $carros= Carro::all();
        return response()->json($carros->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario=Usuario::where('cedula','=',$request['cedula'])->firstOrFail();
        
        Carro::create([
                    'usuario_id' => $usuario['id'],
                    'placa' => $request ['placa'],
                    'marca' => $request ['marca'],
                    'modelo' => $request ['modelo'],
                ]);
        return response()->json(["mensaje"=>"Vehiculo creado correctamente"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro= Carro::select('carros.*','usuarios.*')->join('usuarios','carros.usuario_id','=','usuarios.id')->where('placa','=',$id)->firstOrFail();
        return response()->json(["mensaje" => "success",
                                "carro" => $carro
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
        Carro::where('placa','=',$id)->update([
                  'placa' => $request['placa'],
                  'marca' => $request['marca'],
                  'modelo' => $request['modelo'],
                 ]);
        return response()->json(['mensaje'=>'Vehiculo actualizado correctamente']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro= Carro::where('placa','=',$id)->firstOrFail();
        $carro->delete();
        return response()->json(['mensaje'=>'Vehiculo eliminado correctamente']);
    }
}
