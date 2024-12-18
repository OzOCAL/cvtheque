@extends('cvtheque')

@section('contenu')

<h2>Modification d'un métier</h2>
<form method="POST" action="{{route('metiers.update', ['metier'=>$metier->id])}}">
    @method('PUT')
    @csrf
    Libellé :
    <input class="form-control @error('libelle') is-invalid @enderror" type="text" name="libelle" id="libelle" value="{{old('libelle', $metier->libelle)}}"><br>
    @error('libelle')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Description :
    <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description">{{old('description', $metier->description)}}</textarea>
    @error('description')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Slug :
    <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="slug" value="{{old('slug', $metier->slug)}}"><br>
    @error('libelle')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
</div>

    <div class="btns mt-5 d-flex w-100 justify-content-around">
        <a class="btn btn-info" href="{{route('metiers.index')}}">Retour</a>
        <button type="submit" class="btn btn-success">Valider la modification</button>
    </div>

@endsection