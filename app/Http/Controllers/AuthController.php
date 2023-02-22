<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }


    //autenticação login
    public function login(Request $request)
    {

      $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O campo email deve ser um email válido',
                'password.required' => 'O campo senha é obrigatório'
            ]
        );

        $user = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);


        if (!$user) {
            return redirect()->back()->with('error', 'Usuário ou senha inválidos');
        }

        $user = User::where('email', $request->email)->first();

        $user->createToken('auth-token')->plainTextToken;

        return redirect()->route('admin.home')->with('success', 'Usuário logado com sucesso!');


    }



    //logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $request->session()->invalidate();

       return redirect()->route('login')->with('success', 'Usuário deslogado com sucesso!');
    }
}
