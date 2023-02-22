@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Atualizar Dados do Usuário</h1>

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


            <form action="{{ route('admin.users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nome" value="{{ $user->name }}">
                <input type="text" name="email" placeholder="Email" value="{{ $user->email }}">
                <div class="foto">
                    @if($user->photo)
                    <img src="{{ url('uploads/users/'.$user->photo) }}" alt="Foto do Usuário">
                    @else
                    <img src="{{ url('images/avatar.png') }}" alt="Foto do Usuário">
                    @endif
                    <input type="file" name="photo" class="file" value="{{ $user->photo }}">
                </div>
                <button type="submit" class="btn-submit">Atualizar</button>
            </form>
        </div>

        <div class="box-form">
            <h1>Atualizar Senha</h1>

            @if (session('successPassword'))
            <p class="alert alert-success">
                <span class="material-symbols-outlined">
                    check_circle
                </span>
                {{ session('successPassword') }}
            </p>
            @elseif (session('errorPassword'))
            <p class="alert alert-danger">
                <span class="material-symbols-outlined">
                    warning
                </span>
                {{ session('errorPassword') }}
            </p>
            @endif

            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="alert alert-alert">
                        <span class="material-symbols-outlined">
                            warning
                        </span>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.users.password',$user->id) }}" method="post">
                @csrf
                <input type="password" name="current_password" placeholder="Senha atual">
                <input type="password" name="new_password" placeholder="Nova senha">
                <button type="submit" class="btn-submit">Atualizar Senha</button>
            </form>
        </div>
    </div>
</div>
@endsection
