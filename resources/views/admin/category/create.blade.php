@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
        <div class="box-form">
            <h1>Adicionar Categoria</h1>

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
            <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="titulo" placeholder="Titulo">
                <button type="submit" class="btn-submit">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection
</body>

</html>
