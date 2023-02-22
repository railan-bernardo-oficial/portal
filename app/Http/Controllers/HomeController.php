<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
        $category = new Categories();
        $list = $category::all();

        $posts = new Posts();
        $post = $posts::with('categorie')->orderBy('id', 'desc')->first();
        $all_posts = $posts::with('categorie')->where('id', '!=', $post->id)->limit(3)->get();

        return view('site/home', [
            'page_title' => 'Portal de Notícias',
            'categories' => $list,
            'all_posts' => $all_posts,
            'post' => $post,
        ]);
    }


    //detalhes da noticia
    public function details($category, $slug)
    {
        $category = new Categories();
        $list = $category::all();

        $posts = new Posts();
        $post = $posts::with('categorie', 'autho')->where('slug', $slug)->first();
        $all_posts = $posts::with('categorie')->where('category', $post->category)->where('slug', '!=', $slug)->limit(8)->get();

        return view('site/post', [
            'page_title' => 'Portal de Notícias',
            'categories' => $list,
            'posts_categories' => $all_posts,
            'post' => $post,
            'tempo_leitura'=> ceil(str_word_count(strip_tags($post->content))/200),
        ]);
    }


    //filtro de posts
    public function search(Request $request)
    {

        $categorias = Categories::all();

        $all_posts = Posts::where('title', 'like', '%' . $request->search . '%')
            ->with('categorie')
            ->get();

        return view('site/filter', [
            'page_title' => 'Portal de Notícias - Pesquisa',
            'posts' => $all_posts,
            'search' => $request->search,
            'categories' => $categorias,
        ]);
    }

        //listar posts por categoria
        public function category($slug)
        {
            $category = new Categories();
            $list = $category::all();

            $posts = new Posts();
            $categ = $category::where('slug', $slug)->first();
            $all_posts = $posts::with('categorie')->where('category', $categ->id)->limit(50)->get();

            return view('site/category', [
                'page_title' => 'Portal de Notícias',
                'categories' => $list,
                'posts_categories' => $all_posts,
                'categ' => $categ,
            ]);
        }


}
