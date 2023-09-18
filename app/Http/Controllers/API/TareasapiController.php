<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TareasapiController extends Controller
{
    public function loginUser(Request $request)
    {
        $input = $request->all();
        Auth::attempt($input);
        $user = Auth::user();
        //crear token
        $token = $user->createToken('example')->accessToken;

        return Response(['status' => 200, 'token' => $token],200);
    }

    public function getUserDetail()
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return Response(['data' => $user],200);
        }
        return Response(['data' => 'Usuario No Autenticado'],401);

    }

    public function userLogout()
    {
        if(Auth::guard('api')->check()){
            $accessToken = Auth::guard('api')->user()->token();

            \DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken)
                ->update(['revoked' => true]);
            $accessToken->revoke();

            return Response(['data' => 'Usuario No Autenticado', 'message' => 'Usuario Logout Con Éxito.'],200);
        }
        return Response(['data' => 'Usuario No Autenticado'],401);
    }

    public function listTask()
    {
        if(Auth::guard('api')->check()){
            $tareas = Tarea::all();
            return Response(['Tareas' => $tareas],200);
        }
        return Response(['data' => 'Usuario No Autenticado'],401);

    }

    public function createTask(Request $request)
    {
        if(Auth::guard('api')->check()){

            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'creation_date' => 'required',
                'user_id' => 'required',
            ]);

            $tarea = Tarea::create($request->all());
            if($tarea){
                return Response(['message' => 'Tarea creada con éxito', 'Data' => $tarea],200);
            }else{
                return Response(['message' => 'Asegurate que todos los campos esten bien diligenciados y exista la data proporcionada', 'ERROR' => $tarea],422 );
            }

        }
        return Response(['data' => 'Usuario No Autenticado'],401);

    }

    public function updatetask($id, Request $request)
    {
        if(Auth::guard('api')->check()){

            // Encuentra la tarea por su ID
            $tarea = Tarea::find($id);

            // Verifica si la tarea fue encontrada
            if (!$tarea) {
                return response(['message' => 'La tarea no fue encontrada'], 404);
            }

            // Valida los datos del request (si es necesario)
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'creation_date' => 'required',
                'user_id' => 'required',
            ]);

            $tarea->name = $request->input('name');
            $tarea->description = $request->input('description');
            $tarea->creation_date = $request->input('creation_date');
            $tarea->expiration_date = $request->input('expiration_date');
            $tarea->user_id  = $request->input('user_id');
            $tarea->save();

            if($tarea){
                return Response(['message' => 'Tarea actualizada Con Éxito', 'Data' => $tarea],200);
            }else{
                return Response(['message' => 'Asegurate que todos los campos esten bien diligenciados y exista la data proporcionada', 'ERROR' => $tarea],422 );
            }

        }
        return Response(['data' => 'Usuario No Autenticado'],401);

    }

    public function deletetask($id)
    {
        if(Auth::guard('api')->check()){

            // Encuentra la tarea por su ID
            $tarea = Tarea::find($id);

            // Verifica si la tarea fue encontrada
            if (!$tarea) {
                return response(['message' => 'La tarea no fue encontrada'], 404);
            }

            $tarea->delete();

            if($tarea){
                return Response(['message' => 'Tarea Eliminada Con Éxito', 'Data' => $tarea],200);
            }

        }
        return Response(['data' => 'Usuario No Autenticado'],401);

    }

}
