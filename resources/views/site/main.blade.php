<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title }}</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header class="main-header">
        <div class="logo">
            <a href="{{ route('site.home') }}">Portal News</a>
        </div>
        <div class="search">
            <form action="{{ route('site.search') }}" method="get">
                <input type="text" name="search" placeholder="O que você procura?" id="search">
                <button type="submit" class="btn-search"><span class="material-symbols-outlined">
                        search
                    </span></button>
            </form>
        </div>
        <nav class="main-nav">
            <ul class="main-ul">
                <li><a href="{{ route('site.home') }}">Home</a></li>
                <li class="open-submenu"><a href="javascript:void(0)" class="link-open">Notícias
                        <span class="material-symbols-outlined">
                            keyboard_arrow_down
                        </span></a>
                        <ul class="main-ul-categories">
                            @foreach ($categories as $category)
                            <li><a href="{{ route('site.list.news', $category->slug) }}">{{ $category->titulo }}</a></li>
                            @endforeach
                        </ul>
                    </li>
            </ul>
        </nav>
    </header>
    @yield('content')
    <footer class="footer">
        <p>&copy; <?= date('Y') ?> - Todos os direitos reservados</p>
    </footer>
</body>

</html>
