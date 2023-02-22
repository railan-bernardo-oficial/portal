@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Atualizar Categoria</h1>

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


            <form action="{{ route('admin.category.update',$categ->id) }}" method="post">
                @csrf
                <input type="text" name="titulo" placeholder="Titulo" value="{{ $categ->titulo }}">

                <button type="submit" class="btn-submit">Atualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection
