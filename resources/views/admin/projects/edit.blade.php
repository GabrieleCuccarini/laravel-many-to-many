@extends('layouts.app');

@section('content')
<div class="container">
    <h1>Modifica Progetto #{{ $project->id }}</h1>

    <form enctype="multipart/form-data" action="{{ route('admin.projects.update', $project->id) }}" method="POST">
    @csrf
    @method('put')
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $project->name) }}">
            @error('name')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descrizione</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $project->description) }}">
            @error('description')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Immagine</label>
            <input type="file" class="form-control @error('cover_img') is-invalid @enderror"
            name="cover_img" value="{{ old('cover_img', $project->cover_img) }}">
            @error('cover_img')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror

            <img src="{{ asset('storage/' . $project->cover_img) }}" alt="" class="img-thumbnail">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Link Github</label>
            <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link', $project->link) }}">
            @error('link')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tipologia</label>
            <select class="form-select form-select-sm mb-3" aria-label="form-select-sm" name='type_id'>
                <option selected value=''>Scegli la tipologia</option>
                <option value="1">HTML</option>
                <option value="2">JS</option>
                <option value="3">VITE/VUE</option>
                <option value="4">LARAVEL</option>
            </select>
            @error('type_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="mb-1"><b>Tecnologie</b></div>
            @foreach ($technologies as $technology)
            <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
            {{-- Il name dell'input ha come suffisso le quadre [] che indicheranno al server,
                    di creare un array con i vari tag che stiamo inviando --}}
            <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox"
                id="CheckTechnology_{{ $loop->index }}" value="{{ $technology->id }}" name="technologies[]"
                {{ in_array( $technology->id, old('technologies', [])) ? 'checked' : '' }}
                >
            <label class="form-check-label" for="CheckTechnology_{{ $loop->index }}">{{ $technology->tech_name }}</label>
            </div>
            @endforeach

            @error('technologies')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>

    <button class="btn btn-primary" type="submit">Salva le modifiche</button>
    </form>
</div>
@endsection