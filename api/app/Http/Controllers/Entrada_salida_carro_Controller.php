<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada_salida_carro;
use App\Models\Carro;
use App\Models\Carro_dentro;
use Carbon\Carbon;


class Entrada_salida_carro_Controller extends Controller
{
    public function __construct(){
        $this->middleware('cors');
    }

    public function entrada_salida($id)
    {
    	$carro=Carro::select('carros.*','usuarios.*')->join('usuarios','carros.usuario_id','=','usuarios.id')->where('carros.placa','=', $id)->get();
        if(!sizeof($carro)){
            return response()->json([]);
        }

        foreach ($carro as $car) {
            $carro_dentro=$car;
        }

        $placas=Entrada_salida_carro::where('placa','=', $id)->get();
    	if(sizeof($placas)){
    		foreach ($placas as $placa) {
    			$estado=$placa->estado;
    		}
    		if($estado==1){
    			Entrada_salida_carro::create([
                    'placa' => $id,
                    'estado' => 0,
                ]);
                $salida = Carro_dentro::where('placa','=',$id)->delete();
        		return response()->json($carro_dentro);
    		}else{
    			Entrada_salida_carro::create([
                    'placa' => $id,
                    'estado' => 1,
                ]);
                Carro_dentro::create([
                    'placa' => $id,
                ]);
                return response()->json($carro_dentro);
    		}
    	}else{
    		Entrada_salida_carro::create([
                    'placa' => $id,
                    'estado' => 1,
                ]);
            Carro_dentro::create([
                    'placa' => $id,
                ]);
                return response()->json($carro_dentro);
    	}
    }

    public function fecha()
    {
        $date = Carbon::now()->format('m');
        $dia_entrada=Entrada_salida_carro::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->where('estado', '=' , 1)->count();
        $dia_salida=Entrada_salida_carro::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->where('estado', '=' , 0)->count();
        $mes_entrada=Entrada_salida_carro::whereMonth('created_at', '=', Carbon::now()->format('m'))->where('estado', '=' , 1)->count();
        $mes_salida=Entrada_salida_carro::whereMonth('created_at', '=', Carbon::now()->format('m'))->where('estado', '=' , 0)->count();
        $año_entrada=Entrada_salida_carro::whereYear('created_at', '=', Carbon::now()->format('Y'))->where('estado', '=' , 1)->count();
        $año_salida=Entrada_salida_carro::whereYear('created_at', '=', Carbon::now()->format('Y'))->where('estado', '=' , 0)->count();
        return response()->json([
                                    "dia_entrada" => $dia_entrada,
                                    "dia_salida" => $dia_salida,
                                    "mes_entrada" => $mes_entrada,
                                    "mes_salida" => $mes_salida,
                                    "ano_entrada" => $año_entrada,
                                    "ano_salida" => $año_salida
                                ]);
    }


    public function carroHoy()
    {
        $carros=Entrada_salida_carro::select('entrada_salida_carros.created_at as fecha','entrada_salida_carros.estado','carros.*')->join('carros','carros.placa','=','entrada_salida_carros.placa')->whereDate('entrada_salida_carros.created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        return response()->json($carros->toArray());
    }

    public function carroMes()
    {
        $carros=Entrada_salida_carro::select('entrada_salida_carros.created_at as fecha','entrada_salida_carros.estado','carros.*')->join('carros','carros.placa','=','entrada_salida_carros.placa')->whereMonth('entrada_salida_carros.created_at', '=', Carbon::now()->format('m'))->get();
        return response()->json($carros->toArray());
    }

    public function carroAno()
    {
        $carros=Entrada_salida_carro::select('entrada_salida_carros.created_at as fecha','entrada_salida_carros.estado','carros.*')->join('carros','carros.placa','=','entrada_salida_carros.placa')->whereYear('entrada_salida_carros.created_at', '=', Carbon::now()->format('Y'))->get();
        return response()->json($carros->toArray());
    }

    public function carros_dentro()
    {
        $carros=Carro_dentro::select('carros_dentro.placa as matricula' , 'carros.*')->join('carros','carros.placa','=','carros_dentro.placa')->get();
        return response()->json($carros->toArray());
    }


    public function todos_los_carros()
    {
        $carros=Entrada_salida_carro::select('entrada_salida_carros.created_at as fecha','entrada_salida_carros.estado','carros.*')->join('carros','carros.placa','=','entrada_salida_carros.placa')->get();
        return response()->json($carros->toArray());
    }

    public function filtrar_carros(Request $request)
    {
        $carros=Entrada_salida_carro::select('entrada_salida_carros.created_at as fecha','entrada_salida_carros.estado','carros.*')->join('carros','carros.placa','=','entrada_salida_carros.placa')->whereDate('entrada_salida_carros.created_at', '>=', $request['fecha_inicio'])->whereDate('entrada_salida_carros.created_at', '<=', $request['fecha_fin'])->get();

        /*->whereDate('created_at', '>=', $request['fecha_inicio'])->whereDate('created_at', '<=', $request['fecha_fin'])*/
        return response()->json($carros->toArray());
    }
}
