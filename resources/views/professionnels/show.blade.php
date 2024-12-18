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
    <input class="form-control" type="text" name="cp" id="cp" value="{{$professionnel->cp}}" readonly><br>

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
    <div class="form-group row">
        @if(isset($professionnel->cv))        
        <div class="col-md-8 col-form-label ">            
            <a href="{{asset('storage/'.$professionnel->cv)}}" target="_blank">Voir le CV</a>        
        </div>    
        @else        
        <div class="col-md-8 col-form-label ">            
            Il n'y a aucun CV d'associé à ce profil.        
        </div>    
        @endif
    </div>

    Métier :
    <input type="text" name="metier_id" class="form-control" value="{{$professionnel->metier->libelle}}" readonly><br>

    Compétences :
    <input type="text" name="competences[]" class="form-control"
            value="{{$competences}}"
            readonly>

    </select>
    @error('competences')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    
    Source :
    <input class="form-control" type="text" name="source" id="source" value="{{$professionnel->source}}" readonly><br>

    Observation :
    <textarea class="form-control" type="text" name="observation" id="observation" readonly>{{$professionnel->observation}}</textarea>

</div>

    <div class="btns mt-5 d-flex w-100 justify-content-around">
        <a class="btn btn-info" href="{{route('professionnels.index')}}">Retour</a>
    </div>

</form>

@endsection