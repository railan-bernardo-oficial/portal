<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    //listar  usuários
    public function index()
    {
        $users = User::all();
        return view('admin/users/home', [
            'page_title' => 'Usuários',
            'users' => $users
        ]);
    }

    //view para atualizar  usuário
    public function show($id)
    {
        $user = User::find($id);
       return view('admin/users/edit', [
        'page_title' => 'Atualizar usuário',
        'user' => $user
       ]);
    }

    //view para criar  usuário
    public function create()
    {
        return view('admin/users/create',
            [
                'page_title' => 'Adicionar usuário'
            ]);
    }

    //salvar  usuário no banco
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
            return redirect()->route('admin.list.users')->with('success', 'Usuário criado com sucesso!');
        }
    }



    //atualizar  usuário
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if (File::exists('uploads/users/' . $user->photo)) {
                File::delete('uploads/users/' . $user->photo);
            }
            $image = $request->file('photo');
            $file = md5($image->getClientOriginalName() . time()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/users');
            $image->move($destinationPath, $file);
            $user->photo = $file;
        }

        $user->save();

        return redirect()->route('admin.show.user', $id)->with('success', 'Usuário atualizado com sucesso!');
    }

    //atualizar  senha do usuário
    public function change_password(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ],[
            'current_password.required' => 'O campo senha atual é obrigatório',
            'new_password.required' => 'O campo nova senha é obrigatório',
            'new_password.min' => 'O campo nova senha deve ter no mínimo 6 caracteres'
        ]);

        $user = User::find($id);

        if (!Hash::check($request->current_password, $user->password)) {
           return redirect()->route('admin.show.user', $id)->with('errorPassword', 'Senha atual incorreta!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.show.user', $id)->with('successPassword', 'Senha atualizada com sucesso!');
    }

    //deletar usuário
    public function destroy($id)
    {
        $user = User::find($id);
        if (File::exists('uploads/users/' . $user->photo)) {
            File::delete('uploads/users/' . $user->photo);
        }
        $user->delete();

        return redirect()->route('admin.list.users')->with('error', 'Usuário deletado com sucesso!');
    }
}
