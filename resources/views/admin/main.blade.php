<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body>
    <header class="main-header">
        <div class="main-content main-flex-content">
            <div class="main-logo">
                <a href="{{ route('admin.home') }}">
                    Painel de Controle
                </a>
            </div>
            <div class="main-menu">
                <ul>
                    <li class="main-perfil">
                        <a href="{{ route('admin.home') }}">
                            @if(auth()->user()->photo)
                            <img src="/uploads/users/{{ auth()->user()->photo }}" alt="avatar" />
                            @else
                            <img src="/images/avatar.png" alt="avatar" />
                            @endif
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="main-box-perfil">
                            <li><a href="{{ route('admin.show.user', auth()->user()->id) }}">Perfil</a></li>
                            <li><a href="{{ route('admin.logout') }}">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <article class="main-nav-left">
        <div class="content-nav">
            <ul>
                <li>
                    <a href="{{ route('admin.home') }}">
                        <span class="material-symbols-outlined">
                            dashboard
                        </span>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.list.posts') }}">
                        <span class="material-symbols-outlined">
                            article
                        </span>
                        Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.list.categorys') }}">
                        <span class="material-symbols-outlined">
                            category
                        </span>
                        Categorias
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.list.users') }}">
                        <span class="material-symbols-outlined">
                            people
                        </span>
                        Usuários
                    </a>
                </li>
                <li>
                    <a href="{{ route('site.home') }}">
                        <span class="material-symbols-outlined">
                            logout
                        </span>
                        Portal
                    </a>
                </li>
            </ul>
        </div>
    </article>
    @yield('content')
    <footer class="main-footer">
         <p>&copy; <?= date('Y') ?> Todos os diretos Reservados</p>
    </footer>
</body>
</html>
