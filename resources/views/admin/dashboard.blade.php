@extends('layouts.app')

@section('content')
  <div class="container">
    {{--  <div class="nav justify-content-center">
      <div class="nav-link">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-link">Post</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-link">Categorie</a>
      </div>
    </div>
 --}}

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header">{{ __('Dashboard') }}</div>

          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <h4>Benvenuto {{ Auth::user()->name }}!</h4>

            <p>
              {{-- Abiti in {{ Auth::user()->userDetail->address }}, {{ Auth::user()->userDetail->city }} --}}
            </p>

            @if (Auth::user()->role === 'admin')
              <p class="lead">
                Nel tuo sistema hai:
              <ul>
                <li>Utenti: {{ $users->count() }}</li>
                <li>Post: {{ $lastPosts->count() }}</li>
              </ul>
              </p>
            @endif

          </div>
        </div>

        @if (Auth::user()->role === 'admin')
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center">Ultimi 5 utenti
              <a href="{{ route('admin.users.index') }}" class="btn btn-link ms-auto">Tutti gli utenti</a>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ruolo</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $singleUser)
                    <tr>
                      <td>{{ $singleUser->id }}</td>
                      <td>{{ $singleUser->name }}</td>
                      <td>{{ $singleUser->email }}</td>
                      <td>{{ $singleUser->role }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header d-flex align-items-center">Ultimi 5 post
              <a href="{{ route('admin.posts.index') }}" class="btn btn-link ms-auto">Tutti i post</a>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Cover</th>
                    <th>Titolo</th>
                    <th>Publico</th>
                    <th>Stato</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($lastPosts as $post)
                    <tr>
                      <td>{{ $post->id }}</td>
                      <td><img src="{{ $post->cover_img }}" alt="" style="width: 60px"></td>
                      <td>{{ $post->title }}</td>
                      <td>{{ $post->public ? 'Si' : 'No' }}</td>
                      <td>{{ $post->status }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

        @endif
      </div>
    </div>
  </div>
@endsection