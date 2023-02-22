
@extends('site/main')

@section('content')
<main class="main-container">
    <div class="content">
        <header class="content-header">
            <h1>Resultado da Sua Pesquisa por {{ $search }}</h1>
        </header>
        <section class="row-container margin-bottom-100">
            <article class="box-bloco w-100">
                <ul>
                    @foreach ($posts as $post)
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
