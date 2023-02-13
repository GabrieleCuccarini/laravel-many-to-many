@extends('layouts.app')

@section('content')

<div class="container-fluid w90 m5-auto mt-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Utente</th>
                <th>Email di registrazione</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>  
</div>
@endsection