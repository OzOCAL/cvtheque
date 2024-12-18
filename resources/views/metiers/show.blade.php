@extends('cvtheque')

@section('contenu')
<div class="infos">
    Libellé :
    <input type="text" name="intitule" id="intitule" value="{{$metier->libelle}}" readonly><br>
    Description :
    <input type="text" name="description" id="description" value="{{$metier->description}}" readonly><br>
    Slug :
    <input type="text" name="slug" id="slug" value="{{$metier->slug}}" readonly><br>
</div>

    <div class="btns">
        <a class="btn btn-info" href="{{route('metiers.index')}}">Retour</a>
    </div>

@endsection