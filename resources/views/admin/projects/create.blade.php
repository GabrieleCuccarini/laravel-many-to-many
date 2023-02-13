@extends('layouts.app')

@section('content')
<div class="container">
    <form enctype="multipart/form-data" action="{{ route('admin.projects.store') }}" method="POST">
    @csrf
        <div class="mb-3">
            <label class="form-label"><b>Nome</b></label>
            <input type="text"
            class="form-control @error('name') is-invalid @elseif(old('name')) is-valid @enderror"
            name="name" value="{{ $errors->has('name') ? '' : old('name') }}">

        <div class="mb-3">
            <label class="form-label"><b>Descrizione</b></label>
            <input type="text"
            class="form-control @error('description') is-invalid @elseif(old('description')) is-valid @enderror"
            name="description" value="{{ $errors->has('description') ? '' : old('description') }}">

        <div class="mb-3">
            <label class="form-label"><b>Immagine</b></label>
            <input type="file" class="form-control  @error('cover_img') is-invalid @enderror" name="cover_img"
            value="{{ old('cover_img') }}">
            @error('cover_img')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"><b>Github</b></label>
            <input type="text"
            class="form-control @error('link') is-invalid @elseif(old('link')) is-valid @enderror"
            name="link" value="{{ $errors->has('link') ? '' : old('link') }}">
        </div>

        <div class="mb-3">
            <label class="form-label"><b>Tipologia</b></label>
            <select class="form-select form-select-sm mb-3" aria-label="form-select-sm example" name='type_id'>
                <option selected>Scegli la tipologia</option>
                <option value="1">HTML</option>
                <option value="2">JS</option>
                <option value="3">VITE/VUE</option>
                <option value="4">PHP/LARAVEL</option>
              </select>
        </div>

        <div class="mb-3">
            <div class="mb-1"><b>Tecnologie</b></div>
            @foreach ($technologies as $technology)
            <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
            <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox"
                id="CheckTechnology {{ $loop->index }}" value="{{ $technology->id }}" name="technologies[]"
                {{ in_array( $technology->id, old('technologies', [])) ? 'checked' : '' }}
                >
            <label class="form-check-label" for="CheckTechnology {{ $loop->index }}">{{ $technology->tech_name }}</label>
            </div>
            @endforeach

            @error('technologies')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Salva progetto</button>
        
        
        {{--@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    <b>Hai commesso degli errori nella compilazione dei campi:</b>
                    @error('name')<li class="invalid-feedback">{{ $message }}</li> @enderror
                    @error('description')<li class="invalid-feedback">{{ $message }}</li> @enderror
                    @error('cover_img')<li class="invalid-feedback">{{ $message }}</li> @enderror
                    @error('link')<li class="invalid-feedback">{{ $message }}</li> @enderror
                </ul>
            </div>  
        @else
            
        @endif --}}
        {{-- CHECK DEGLI ERRORI COMPLESSIVO  --}}
        @if ($errors->any())
        <div class="alert alert-danger">
        I dati inseriti non sono validi:

        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif
    </form>
</div>
@endsection
