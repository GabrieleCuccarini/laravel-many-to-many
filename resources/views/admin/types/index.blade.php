@extends('layouts.app');

@section('content')

<div class="container-fluid w90 m5-auto mt-3 text-center">
  <h1 class="d-flex justify-content-between">
      Lista Types
      <a href="{{ route('admin.types.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Aggiungi Type
      </a>
    </h1>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Linguaggio</th>
          <th>Azioni</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type['id'] }}</td>
            <td>{{ $type->linguaggio }}</td>
            <td>
              <a href="{{ route('admin.types.show', $type->id) }}" class="btn btn-link">
                <i class="fas fa-eye"></i>
              </a>

              <a href="{{ route('admin.types.edit', $type->id) }}" class="btn btn-link">
                <i class="fa-solid fa-pencil"></i>      
              </a>

              <form method='POST' action="{{ route('admin.types.destroy', $type->id) }}"
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
  {{-- @dd($types); --}}
@endsection