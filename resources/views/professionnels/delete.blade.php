@extends('cvtheque')

@section('contenu')

<h2>{{$titre}}</h2>
<div class="infos">

    Nom :
    <input class="form-control" type="text" name="nom" id="nom" value="{{$professionnel->nom}}" readonly><br>

    Prénom :
    <input class="form-control" type="text" name="prenom" id="prenom" value="{{$professionnel->prenom}}" readonly><br>

    Date de naissance :
    <input class="form-control" type="text" name="naissance" id="naissance" value="{{$professionnel->naissance}}" readonly><br>

    Code postal :
    <input class="form-control" type="text" name="cp" id="cp" value="{{$professionnel->naissance}}" readonly><br>

    Ville :
    <input class="form-control" type="text" name="ville" id="ville" value="{{$professionnel->ville}}" readonly><br>

    Téléphone :
    <input class="form-control" type="text" name="tel" id="tel" value="{{$professionnel->tel}}" readonly><br>

    Email :
    <input class="form-control" type="email" name="email" id="email" value="{{$professionnel->email}}" readonly><br>
    
    Formation :
    @if ($professionnel->formation == '1')
    <input class="form-control" type="text" name="formation" id="formation" value="Oui" readonly>
    @else
    <input class="form-control" type="text" name="formation" id="formation" value="Non" readonly><br>
    @endif
    <br>
    Domaine :
    <input 
        type="text" 
        name="domaine[]" 
        id="domaine_s" 
        value="{{ $professionnel->domaine}}" 
        class="form-control"
        readonly
    >

    Métier :
    <input type="text" name="metier_id" class="form-control" value="{{$professionnel->metier->libelle}}" readonly><br>
    
    Source :
    <input class="form-control" type="text" name="source" id="source" value="{{$professionnel->source}}" readonly><br>

    Observation :
    <textarea class="form-control" type="text" name="observation" id="observation" readonly>{{$professionnel->observation}}</textarea>

</div>

<form action="{{ route('professionnels.destroy', $professionnel->id) }}" method="POST">
    @method('DELETE')
    @csrf
    <a class="btn btn-info" href="{{route('professionnels.index')}}">Retour</a>
    <button type="submit" class="btn btn-danger">Supprimer</button>
</form>


@endsection