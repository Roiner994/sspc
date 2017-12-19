<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entrada_salida_usuario;
use App\Models\Usuario;
use App\Models\Usuario_dentro;
use Carbon\Carbon;
 

class Entrada_salida_usuario_Controller extends Controller
{
    public function __construct(){
        $this->middleware('cors');
    }

    public function entrada_salida($id)
    {
    	$users= Usuario::where('cedula', '=', $id)->get();
    	if(sizeof($users)){
    		foreach ($users as $user) {
    			$id_usuario=$user->id;
                $usuario_dentro=$user;
    		}
    	}else{
    		return response()->json([]); 
    	}
    	$usuarios=Entrada_salida_usuario::where('id_usuario','=',$id_usuario)->get();
    	if(sizeof($usuarios)){
    		foreach ($usuarios as $usuario) {
    			$estado=$usuario->estado;
    		}
    		if($estado==1){
    			Entrada_salida_usuario::create([
                    'id_usuario' => $id_usuario,
                    'estado' => 0,
                ]);
                $salida = Usuario_dentro::where('id_usuario','=',$id_usuario)->delete();
        		return response()->json(["mensaje"=>"el usuario ha salido"]);
    		}else{
    			Entrada_salida_usuario::create([
                    'id_usuario' => $id_usuario,
                    'estado' => 1,
                ]);
                Usuario_dentro::create([
                    'id_usuario' => $id_usuario,
                ]);
                return response()->json($usuario_dentro);
    		}
    	}else{
    		Entrada_salida_usuario::create([
                    'id_usuario' => $id_usuario,
                    'estado' => 1,
            ]);
            Usuario_dentro::create([
                    'id_usuario' => $id_usuario,
                ]);
            return response()->json($usuario_dentro);
    	}
    }

    public function fecha()
    {
    	$date = Carbon::now()->format('m');
    	$dia_entrada=Entrada_salida_usuario::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->where('estado', '=' , 1)->count();
    	$dia_salida=Entrada_salida_usuario::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->where('estado', '=' , 0)->count();
    	$mes_entrada=Entrada_salida_usuario::whereMonth('created_at', '=', Carbon::now()->format('m'))->where('estado', '=' , 1)->count();
    	$mes_salida=Entrada_salida_usuario::whereMonth('created_at', '=', Carbon::now()->format('m'))->where('estado', '=' , 0)->count();
    	$año_entrada=Entrada_salida_usuario::whereYear('created_at', '=', Carbon::now()->format('Y'))->where('estado', '=' , 1)->count();
    	$año_salida=Entrada_salida_usuario::whereYear('created_at', '=', Carbon::now()->format('Y'))->where('estado', '=' , 0)->count();
    	return response()->json([
    								"dia_entrada" => $dia_entrada,
    								"dia_salida" => $dia_salida,
    								"mes_entrada" => $mes_entrada,
    								"mes_salida" => $mes_salida,
    								"ano_entrada" => $año_entrada,
    								"ano_salida" => $año_salida
    							]);
    }

    public function usuarioHoy()
    {
        $usuarios=Entrada_salida_usuario::select('entrada_salida_usuarios.created_at as fecha','entrada_salida_usuarios.estado','usuarios.*')->join('usuarios','usuarios.id','=','entrada_salida_usuarios.id_usuario')->whereDate('entrada_salida_usuarios.created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        return response()->json($usuarios->toArray());
    }

    public function usuarioMes()
    {
        $usuarios=Entrada_salida_usuario::select('entrada_salida_usuarios.created_at as fecha','entrada_salida_usuarios.estado','usuarios.*')->join('usuarios','usuarios.id','=','entrada_salida_usuarios.id_usuario')->whereMonth('entrada_salida_usuarios.created_at', '=', Carbon::now()->format('m'))->get();
        return response()->json($usuarios->toArray());
    }

    public function UsuarioAno()
    {
        $usuarios=Entrada_salida_usuario::select('entrada_salida_usuarios.created_at as fecha','entrada_salida_usuarios.estado','usuarios.*')->join('usuarios','usuarios.id','=','entrada_salida_usuarios.id_usuario')->whereYear('entrada_salida_usuarios.created_at', '=', Carbon::now()->format('Y'))->get();
        return response()->json($usuarios->toArray());
    }

    public function usuarios_dentro()
    {
        $usuarios=Usuario_dentro::select('usuarios_dentro.*' , 'usuarios.*')->join('usuarios','usuarios.id','=','usuarios_dentro.id_usuario')->get();
        return response()->json($usuarios->toArray());
    }

    public function todos_los_usuarios()
    {
        $usuarios=Entrada_salida_usuario::select('entrada_salida_usuarios.created_at as fecha','entrada_salida_usuarios.estado','usuarios.*')->join('usuarios','usuarios.id','=','entrada_salida_usuarios.id_usuario')->get();
        return response()->json($usuarios->toArray());
    }

    public function filtrar_usuarios(Request $request)
    {
        $usuarios=Entrada_salida_usuario::select('entrada_salida_usuarios.created_at as fecha','entrada_salida_usuarios.estado','usuarios.*')->join('usuarios','usuarios.id','=','entrada_salida_usuarios.id_usuario')->whereDate('entrada_salida_usuarios.created_at', '>=', $request['fecha_inicio'])->whereDate('entrada_salida_usuarios.created_at', '<=', $request['fecha_fin'])->get();

        /*->whereDate('created_at', '>=', $request['fecha_inicio'])->whereDate('created_at', '<=', $request['fecha_fin'])*/
        return response()->json($usuarios->toArray());
    }
}