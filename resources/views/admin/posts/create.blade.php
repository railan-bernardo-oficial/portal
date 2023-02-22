@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Cadastrar Postagem</h1>

            @if (session('success'))
            <p class="alert alert-success">
                <span class="material-symbols-outlined">
                    check_circle
                </span>
                {{ session('success') }}
            </p>
            @elseif (session('error'))
            <p class="alert alert-danger">
                <span class="material-symbols-outlined">
                    warning
                </span>
                {{ session('error') }}
            </p>
            @endif


            <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Titulo">
                <textarea name="description" placeholder="Descrição"></textarea>
                <select name="category">
                    <option value="" selected>Selecione uma categoria</option>
                    @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->titulo }}</option>
                    @endforeach
                </select>
                <div class="foto">
                    <input type="file" name="image" class="file">
                </div>
                <textarea name="content" placeholder="Conteúdo"></textarea>
                <div class="status">
                    <input type="radio" name="status" value="1"> Ativo
                    <input type="radio" name="status" value="0"> Inativo
                </div>
                <button type="submit" class="btn-submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection
