@extends('site/main')

@section('content')
<main class="main-container">
    <div class="content">
        <header class="content-header">
            <h1>{{ $post->title }}</h1>
            <span>Postado: {{ @$post->created_at->format('d/m/Y') }} . <strong>{{ $tempo_leitura }} min</strong> de leitura</span>
        </header>
        <section class="row-container margin-bottom-100">
            <article class="box-hilight">
                <img src="{{ url('uploads/posts/'.$post->image) }}" alt="">
                <div class="author">
                    <img src="{{ url('uploads/users/'.$post->autho->photo) }}" alt="">
                    <p>{{ $post->autho->name }} </p>
                </div>
                <p class="text-content">{{ $post->content }}</p>
            </article>
            <article class="box-bloco">
                <h2 class="title-header-right">Relacionados a {{ $post->categorie->titulo }}</h1>
                <ul>
                    @foreach ($posts_categories as $post)
                    <li class="box-list-post">
                        <a href="{{ route('site.post.news', [$post->categorie->slug, $post->slug]) }}">
                            <img src="{{ url('uploads/posts/'.$post->image) }}" alt="">
                            <h2>{{ $post->title }}</h2>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </article>
        </section>
    </div>
</main>
@endsection
