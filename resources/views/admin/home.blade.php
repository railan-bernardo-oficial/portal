@extends('admin/main')

@section('content')
<div class="main-container">
    <div class="row-content">
       <div class="row-cards">
          <div class="card">
            @if($count_users)
            <h2>{{ $count_users }}</h2>
            @else
            <h2>0</h2>
            @endif
            <span>Usuários</span>
          </div>
          <div class="card">
            @if($count_categories)
            <h2>{{ $count_categories }}</h2>
            @else
            <h2>0</h2>
            @endif
            <span>Categorias</span>
          </div>
          <div class="card">
            @if($count_posts)
            <h2>{{ $count_posts }}</h2>
            @else
            <h2>0</h2>
            @endif
            <span>Posts</span>
          </div>
       </div>
    </div>
</div>
@endsection
