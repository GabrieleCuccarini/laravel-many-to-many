@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{ route('admin.types.store') }}" method="POST">
    @csrf

        <div class="mb-3">
            <label class="form-label">Nome della tipologia</label>
            <input type="text"
            class="form-control @error('linguaggio') is-invalid @elseif(old('linguaggio')) is-valid @enderror"
            name="linguaggio" value="{{ $errors->has('linguaggio') ? '' : old('linguaggio') }}">
        </div>

        <button class="btn btn-primary" type="submit">Salva</button>
        
        
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
