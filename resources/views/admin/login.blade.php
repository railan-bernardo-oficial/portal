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
    <div class="row-container row-login">
        <div class="box-login">
            <h1>Entrar</h1>
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="alert alert-alert">
                <span class="material-symbols-outlined">
                    warning
                </span>
                {{ $error }}
            </p>
            @endforeach
            @endif
            @if(session('error'))
            <p class="alert alert-danger">
                <span class="material-symbols-outlined">
                    warning
                </span>
                {{ session('error') }}
            </p>
            @endif
            <form action="{{ route('login.auth') }}" method="post" autocomplete="off">
                @csrf
                <input type="text" name="email" placeholder="Email" autocomplete="off">
                <input type="password" name="password" placeholder="Senha" autocomplete="off">
                <button type="submit">Entrar</button>
                <a href="{{ route('admin.register') }}" class="register">Criar conta</a>
            </form>
        </div>
    </div>
</body>

</html>
