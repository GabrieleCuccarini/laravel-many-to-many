@extends('layouts.app');

@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID </th>
        <th> Nome </th>
        <th> Descrizione </th>
        <th> Immagine di copertina </th>
        <th> Link Github </th>
        <th> Tipologia </th>
        <th> Tecnologia </th>

      </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ $project['id'] }}</td>
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
        </tr>
    </tbody>
</table>
@endsection