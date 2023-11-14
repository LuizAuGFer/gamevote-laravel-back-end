<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request) {
       
        $user = \DB::table('users')->where('email', '=', $request->email)->first();

        if($user == null) {
           
            try {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->country = $request->country;
                $user->password = request()->password;
                $user->save();

            }catch(\Exception $e) {
                return response()->json(['message' => 'Ocorreu um erro no cadastro do usuário!'])->setStatusCode(422);
            }

            return response()->json(['message' => 'Usuário cadastrado com sucesso!'])->setStatusCode(200);

        }else {
            return response()->json(['message' => 'O email informado não pode ser usado!'])->setStatusCode(422);
        }
    }
}
