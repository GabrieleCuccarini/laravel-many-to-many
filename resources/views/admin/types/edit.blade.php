@extends('layouts.app');

@section('content')
<div class="container">
    <h1>Modifica Tipologia #{{ $type->id }}</h1>

    <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
    @csrf
    @method('put')

        <div class="mb-3">
            <label class="form-label">Linguaggio</label>
            <input type="text" class="form-control @error('linguaggio') is-invalid @enderror" name="linguaggio" value="{{ old('linguaggio', $type->linguaggio) }}">
            @error('linguaggio')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>

    <button class="btn btn-primary" type="submit">Salva le modifiche</button>
    </form>
</div>
@endsection