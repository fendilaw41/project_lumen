<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
  {
      $this->validate($request, [
          'name' => 'required|min:2',
          'email' => 'required|unique:users|email',
          'password' => 'required|min:6'
      ]);

      $name = $request->input('name');
      $email = $request->input('email');
      $password = app('hash')->make($request->input('password'));

      $user = User::create([
          'name' => $name,
          'email' => $email,
          'password' => $password,
      ]);

      return response()->json(['message' => 'Data User Sudah Berhasil Ditambahkan'], 201);
  }

    public function login(Request $request)
    {
  
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()){
          return response()->json($validator->errors(), 422);
        }

        if (! $token = Auth::attempt($validator->validated())) {           
            return response()->json(['message' => 'Anda Tidak Memiliki Akses'], 401);
        }
        return $this->createNewToken($token);
    }

    protected function createNewToken($token){
      return response()->json([
          'user' => auth()->user(),
          'expires_in' => auth()->factory()->getTTL() * 60,
          'token_type' => 'bearer',
          'access_token' => $token
      ]);
    }


    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function destoyToken(Request $request){

       auth()->logout();

       return response()->json([
            'status' => true,
            'message' => "Sukses! Anda Berhasil Logout",
        ], 200);
    }
}
