@extends('cvtheque')

@section('contenu')

<h2>Création d'un métier</h2>
<form class="infos" method="POST" action="{{route('metiers.store')}}">
    @method('POST')
    @csrf
    Intitule :
    <input class="form-control @error('intitule') is-invalid @enderror" type="text" name="libelle" id="libelle" value="{{old('libelle')}}"><br>
    @error('libelle')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Description :
    <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{old('description')}}"></textarea>
    @error('description')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Slug :
    <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{old('slug')}}"><br>
    @error('slug')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
</div>

    <div class="btns mt-5 d-flex w-100 justify-content-around">
        <a class="btn btn-info" href="{{route('metiers.index')}}">Retour</a>
        <button type="submit" class="btn btn-success">Valider la création</button>
    </div>

@endsection