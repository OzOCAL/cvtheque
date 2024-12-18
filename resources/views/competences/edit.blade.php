@extends('cvtheque')

@section('contenu')

<h2>Modification d'une compétence</h2>
<form method="POST" action="{{route('competences.update', ['competence'=>$competence->id])}}">
    @method('PUT')
    @csrf
    Intitule :
    <input class="form-control @error('intitule') is-invalid @enderror" type="text" name="intitule" id="intitule" value="{{old('intitule', $competence->intitule)}}"><br>
    @error('intitule')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Description :
    <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="description">{{old('description', $competence->description)}}</textarea>
    @error('description')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
</div>

    <div class="btns mt-5 d-flex w-100 justify-content-around">
        <a class="btn btn-info" href="{{route('competences.index')}}">Retour</a>
        <button type="submit" class="btn btn-success">Valider la modification</button>
    </div>

@endsection