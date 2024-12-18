@extends('cvtheque')

@section('contenu')
<div class="infos">
    Intitulé :
    <input type="text" name="intitule" id="intitule" value="{{$competence->intitule}}" readonly><br>
    Description :
    <input type="text" name="description" id="description" value="{{$competence->description}}" readonly><br>
</div>

    <div class="btns">
        <a class="btn btn-info" href="{{route('competences.index')}}">Retour</a>
    </div>

@endsection