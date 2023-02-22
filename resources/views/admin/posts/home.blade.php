@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Lista de Postagem</h1>

            <div class="add">
                <a href="{{ route('admin.post.create') }}" class="btn btn-add">
                    <span class="material-symbols-outlined">
                        add_circle
                    </span>
                    Adicionar Usuário</a>
            </div>
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
            <div class="table">
                <div class="table-header temp-col-5">
                    <div class="table-header-th">Capa</div>
                    <div class="table-header-th">Autor</div>
                    <div class="table-header-th">Categoria</div>
                    <div class="table-header-th">Titulo</div>
                    <div class="table-header-th">Ações</div>
                </div>
                <div class="table-body">
                    @foreach($posts as $post)
                    <div class="table-body-tr temp-col-5">
                        <div class="table-body-td td-flex">
                            @if($post->image)
                            <img src="/uploads/posts/{{ $post->image }}" alt="" />
                            @else
                            <img src="/images/avatar.png" alt="" />
                            @endif
                        </div>
                        <div class="table-body-td td-flex">{{ $post->autho->name }}</div>
                        <div class="table-body-td td-flex">{{ $post->categorie->titulo }}</div>
                        <div class="table-body-td td-flex">{{ $post->title }}</div>
                        <div class="table-body-td td-flex">
                            <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-edit">Editar</a>
                            <a href="{{ route('admin.posts.delete', $post->id) }}" class="btn btn-delete">Excluir</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
