<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) {
       
        $user = \DB::table('users')->where('email', '=', $request->email)->first();

        if($user == null) {
           
            try {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->country = $request->country;
                $user->password = hash('sha256', request()->password);
                $user->save();

            }catch(\Exception $e) {
                return response()->json(['message' => 'Ocorreu um erro no cadastro do usuário!'])->setStatusCode(422);
            }

            return response()->json(['message' => 'Usuário cadastrado com sucesso!'])->setStatusCode(200);

        }else {
            return response()->json(['message' => 'O email informado não pode ser usado!'])->setStatusCode(422);
        }
    }

   public function login() {

        $user = User::where('email', '=', request()->email)->where('password', hash('sha256', request()->password))->first();

        if($user) {
            return response()->json(['_token' => $user->createToken('token-game', ['server:update'])->plainTextToken, 'message' => 'Login executado com sucesso!'])->setStatusCode(200);
        }else {
            return response()->json(['message' => 'Erro ao executar login!'])->setStatusCode(422);
        }   
   }

}
