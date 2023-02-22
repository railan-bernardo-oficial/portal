<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Categories;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }

    //view da dashboard
    public function home()
    {
        return view('admin/home', [
            'page_title' => 'Dashboard',
            'count_users' => User::count(),
            'count_posts' => Posts::count(),
            'count_categories' => Categories::count(),
        ]);
    }

    //view de login
    public function login()
    {
        return view('admin/login', [
            'page_title' => 'Login',
        ]);
    }

    //view de cadastro
    public function register()
    {
        return view('admin/register', [
            'page_title' => 'Cadastro',
        ]);
    }

    //registrar  usuário no banco
    public function store(Request $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6'
            ],
            [
                'name.required' => 'O campo nome é obrigatório',
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O campo email deve ser um email válido',
                'password.required' => 'O campo senha é obrigatório',
                'password.min' => 'O campo senha deve ter no mínimo 6 caracteres'
            ]
        );

        $file= "";

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $image = $request->file('photo');
            $file = md5($image->getClientOriginalName() . time()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/users');
            $image->move($destinationPath, $file);
        }

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $user->photo = $file;


        if ($user->save()) {
            $user->createToken('user-create-token')->plainTextToken;
            return redirect()->route('login')->with('success', 'Usuário criado com sucesso!');
        }
    }
}
