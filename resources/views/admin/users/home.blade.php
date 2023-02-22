@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Lista de Usuários</h1>

            <div class="add">
                <a href="{{ route('admin.users.add') }}" class="btn btn-add">
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
                <div class="table-header temp-col-4">
                    <div class="table-header-th">Foto</div>
                    <div class="table-header-th">Nome</div>
                    <div class="table-header-th">Email</div>
                    <div class="table-header-th">Ações</div>
                </div>
                <div class="table-body">
                    @foreach($users as $user)
                    <div class="table-body-tr temp-col-4">
                        <div class="table-body-td">
                            @if($user->photo)
                            <img src="/uploads/users/{{ $user->photo }}" alt="" />
                            @else
                            <img src="/images/avatar.png" alt="" />
                            @endif
                        </div>
                        <div class="table-body-td td-flex">{{ $user->name }}</div>
                        <div class="table-body-td td-flex">{{ $user->email }}</div>
                        <div class="table-body-td td-flex">
                            <a href="{{ route('admin.show.user', $user->id) }}" class="btn btn-edit">Editar</a>
                            <a href="{{ route('admin.users.delete', $user->id) }}" class="btn btn-delete">Excluir</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
