<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategorieController extends Controller
{

    //listar todas as categorias
    public function index()
    {
        $categories = Categories::all();
        return view('admin/category/home', [
            'page_title' => 'Categorias',
            'categories' => $categories
        ]);
    }

    //view criar categoria
    public function create()
    {
        return view('admin/category/create', [
            'page_title' => 'Nova Categoria'
        ]);
    }

    //view editar categoria
    public function show($id)
    {
        $category = Categories::find($id);
        return view('admin/category/edit', [
            'page_title' => 'Categoria - ' . $category->titulo,
            'categ' => $category
        ]);
    }

    //salvar categoria
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required'
        ],
        [
            'titulo.required' => 'O campo título é obrigatório'
        ]);

        $category = new Categories();
        $category->titulo = $request->titulo;
        $category->slug = Str::slug($request->titulo);

        $categ = Categories::where('titulo', $request->titulo)->first();

        if($categ){
            return redirect()->route('admin.category.create')->with('error', 'Categoria já cadastrada!');
        }

        $category->save();

        return redirect()->route('admin.list.categorys')->with('success', 'Categoria cadastrada com sucesso!');
    }

    //atualizar categoria
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required'
        ]);

        $category = Categories::find($id);
        $category->titulo = $request->titulo;
        $category->slug = Str::slug($request->titulo);

        $categ = Categories::where('titulo', $request->titulo)->first();


        if($categ){
            return redirect()->route('admin.show.category', $id)->with('error', 'Categoria já cadastrada!');
        }

        if(!$category->save()){
            return redirect()->route('admin.show.category', $id)->with('error', 'Erro ao atualizar categoria');
        }

       return redirect()->route('admin.list.categorys')->with('success', 'Categoria atualizada com sucesso!');
    }

    //deletar categoria
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();

        return redirect()->route('admin.list.categorys')->with('error', 'Categoria deletada com sucesso!');
    }
}
