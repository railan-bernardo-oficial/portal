@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Atualizar Postagem</h1>

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


            <form action="{{ route('admin.post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Titulo" value="{{ $post->title }}">
                <textarea name="description">{{ $post->description }}</textarea>
                <select name="category">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $post->category == $categorie->id ? 'selected' : '' }}>{{ $categorie->titulo }}</option>
                    @endforeach
                </select>
                <div class="foto">
                    @if($post->image)
                    <img src="{{ url('uploads/posts/'.$post->image) }}" alt="Foto">
                    @else
                    <img src="{{ url('images/avatar.png') }}" alt="Foto">
                    @endif
                    <input type="file" name="image" class="file" value="{{ $post->image }}">
                </div>
                <textarea name="content">{{ $post->content }}</textarea>
                <div class="status">
                    <input type="radio" name="status" value="1" {{ $post->status == 1 ? 'checked' : '' }}> Ativo
                    <input type="radio" name="status" value="0" {{ $post->status == 0 ? 'checked' : '' }}> Inativo
                </div>
                <button type="submit" class="btn-submit">Atualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection
