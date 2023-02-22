@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Lista de Categorias</h1>

            <div class="add">
                <a href="{{ route('admin.category.create') }}" class="btn btn-add">
                    <span class="material-symbols-outlined">
                        add_circle
                    </span>
                    Adicionar Categoria</a>
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
                <div class="table-header temp-col-4">
                    <div class="table-header-th">#</div>
                    <div class="table-header-th">Titulo</div>
                    <div class="table-header-th">Slug</div>
                    <div class="table-header-th">Ações</div>
                </div>
                <div class="table-body">
                    @foreach($categories as $category)
                    <div class="table-body-tr temp-col-4">
                        <div class="table-body-td"># {{ $category->id }}</div>
                        <div class="table-body-td td-flex">{{ $category->titulo }}</div>
                        <div class="table-body-td td-flex">{{ $category->slug }}</div>
                        <div class="table-body-td td-flex">
                            <a href="{{ route('admin.show.category', $category->id) }}" class="btn btn-edit">Editar</a>
                            <a href="{{ route('admin.category.delete', $category->id) }}" class="btn btn-delete">Excluir</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

