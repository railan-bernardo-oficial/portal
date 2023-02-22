<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    //listar todos os posts
    public function index()
    {
        $posts = Posts::with('categorie', 'autho')->orderBy('id', 'desc')->paginate(10);

       return view('admin/posts/home', [
           'page_title' => 'Lista de Postagens',
           'posts' => $posts
       ]);
    }

    //view edit post
    public function show($id)
    {
        $post = Posts::find($id);
      $categories =  Categories::all();
        return view('admin/posts/edit', [
            'page_title' => 'Post - '. $post->title,
            'post' => $post,
            'categories' => $categories
        ]);
    }

    //view criar post
    public function create()
    {
        $categories =  Categories::all();
        return view('admin/posts/create', [
            'page_title' => 'Adicionar Post',
            'categories' => $categories
        ]);
    }

    //salvar post
    public function store(Request $request)
    {

        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'content' => 'required',
        ],
        [
            'category.required' => 'O campo categoria é obrigatório',
            'title.required' => 'O campo título é obrigatório',
            'description.required' => 'O campo descrição é obrigatório',
            'image.required' => 'O campo imagem é obrigatório',
            'content.required' => 'O campo conteúdo é obrigatório',
        ]);

        $post = new Posts();
        $post->slug = Str::slug($request->title);
        $post->category = $request->category;
        $post->author = auth()->user()->id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $file = md5($image->getClientOriginalName() . time()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/posts');
            $image->move($destinationPath, $file);
            $post->image = $file;
        }

        if (!$post->save()) {
            return redirect()->back()->with('error', 'Não foi possível cadastrar o post!');
        }

       return redirect()->route('admin.list.posts')->with('success', 'Post cadastrado com sucesso!');
    }

    //atualizar post
    public function update(Request $request, $id)
    {

        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
        ],
        [
            'category.required' => 'O campo categoria é obrigatório',
            'title.required' => 'O campo título é obrigatório',
            'description.required' => 'O campo descrição é obrigatório',
            'content.required' => 'O campo conteúdo é obrigatório',
        ]);

        $post = Posts::find($id);
        $post->slug = Str::slug($request->title);
        $post->category = $request->category;
        $post->author = auth()->user()->id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if(File::exists('uploads/posts/' . $post->image)){
                File::delete('uploads/posts/' . $post->image);
            }
            $image = $request->file('image');
            $file = md5($image->getClientOriginalName() . time()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/posts');
            $image->move($destinationPath, $file);
            $post->image = $file;
        }

        if (!$post->save()) {
           return redirect()->back()->with('error', 'Não foi possível atualizar o post!');
        }

        return redirect()->route('admin.list.posts')->with('success', 'Post atualizado com sucesso!');
    }

    //deletar post
    public function destroy($id)
    {
        $post = Posts::find($id);
        if(File::exists('uploads/posts/' . $post->image)){
            File::delete('uploads/posts/' . $post->image);
        }
        $post->delete();
        return redirect()->route('admin.list.posts')->with('error', 'Post deletado com sucesso!');
    }





}
