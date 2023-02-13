@extends('layouts.app');

@section('content')

<div class="container-fluid w90 m5-auto mt-3">
  <h1 class="d-flex justify-content-between">
      Lista progetti

      <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Aggiungi
      </a>
    </h1>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Descrizione</th>
          <th>Immagine di copertina</th>
          <th>Link Github</th>
          <th>Tipologia</th>
          <th>Tecnologia</th>
          <th>Azioni</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($projects as $project)
          <tr>
            <td>{{ $project['name'] }}</td>
            <td>{{ $project->description }}</td>
            <td><img src="{{ asset('storage/' . $project->cover_img) }}" alt=""></td>
            <td>{{ $project->link }}</td>
            <td>{{ $project->type_id }}</td>
            <td>
              @foreach ($project->technologies as $technology)
              {{ $technology->tech_name }}
              @endforeach
            </td>
            <td>
              <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-link">
                <i class="fas fa-eye"></i>
              </a>

              <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-link">
                <i class="fa-solid fa-pencil"></i>      
              </a>

              <form method='POST' action="{{ route('admin.projects.destroy', $project->id) }}"
                  class="delete-form d-inline-block">
                  @csrf()
                  @method('delete')

                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>  
  </div>
  {{-- @dd($projects); --}}
@endsection