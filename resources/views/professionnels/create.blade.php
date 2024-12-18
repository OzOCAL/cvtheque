@extends('cvtheque')

@section('contenu')

<h2>Création d'un professionnel</h2>
<form class="infos" method="POST" action="{{route('professionnels.store')}}" enctype="multipart/form-data">
    @method('POST')
    @csrf
    Nom :
    <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="nom" value="{{old('nom')}}"><br>
    @error('nom')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Prénom :
    <input class="form-control @error('prenom') is-invalid @enderror" type="text" name="prenom" id="prenom" value="{{old('prenom')}}"><br>
    @error('prenom')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Date de naissance :
    <input class="form-control @error('naissance') is-invalid @enderror" type="date" name="naissance" id="naissance" value="{{old('naissance')}}"><br>
    @error('naissance')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Code postal :
    <input class="form-control @error('cp') is-invalid @enderror" type="text" name="cp" id="cp" value="{{old('cp')}}"><br>
    @error('cp')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Ville :
    <input class="form-control @error('ville') is-invalid @enderror" type="text" name="ville" id="ville" value="{{old('ville')}}"><br>
    @error('ville')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Téléphone :
    <input class="form-control @error('tel') is-invalid @enderror" type="text" name="tel" id="tel" value="{{old('tel')}}"><br>
    @error('tel')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Email :
    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{old('email')}}"><br>
    @error('email')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Formation :
    <input @error('formation') is-invalid @enderror" type="radio" name="formation" id="formation" value="1"> Oui
    <input @error('formation') is-invalid @enderror" type="radio" name="formation" id="formation" value="0"> Non<br>
    @error('formation')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    <br>
    Domaine :
    <div class="form-check">
        <input 
            type="checkbox" 
            name="domaine[]" 
            id="domaine_s" 
            value="S" 
            {{ in_array('S', old('domaine', [])) ? 'checked' : '' }}
            class="form-check-input @error('domaine') is-invalid @enderror"
        >
        <label for="domaine_s" class="form-check-label">Systèmes</label>
    </div>
    
    <div class="form-check">
        <input 
            type="checkbox" 
            name="domaine[]" 
            id="domaine_r" 
            value="R" 
            {{ in_array('R', old('domaine', [])) ? 'checked' : '' }}
            class="form-check-input @error('domaine') is-invalid @enderror"
        >
        <label for="domaine_r" class="form-check-label">Réseaux</label>
    </div>
    
    <div class="form-check">
        <input 
            type="checkbox" 
            name="domaine[]" 
            id="domaine_d" 
            value="D" 
            {{ in_array('D', old('domaine', [])) ? 'checked' : '' }}
            class="form-check-input @error('domaine') is-invalid @enderror"
        >
        <label for="domaine_d" class="form-check-label">Développement</label>
    </div>
    
    @error('domaine')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    Métier :
    <select name="metier_id" class="form-select" @error('metier_id') is-invalid @enderror>

        <option value="" @if(old('metier_id') == "") selected @endif>Sélectionner le métier</option>

        @foreach($metiers as $metier)
        <option value="{{$metier->id}}" @if(old('metier_id') == $metier->id) selected @endif>{{$metier->libelle}}</option>
        @endforeach
    </select>
    @error('metier_id')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    Compétences :
    <select name="competences[]" class="form-select @error('competences') is-invalid @enderror" multiple>
        <option value="" disabled>Sélectionner une ou plusieurs compétences</option>
        @foreach($competences as $competence)
            <option value="{{$competence->id}}" @if(is_array(old('competences')) && in_array($competence->id, old('competences'))) selected @endif>
                {{$competence->intitule}}
            </option>
        @endforeach
    </select>
    @error('competences')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    CV :
    <input class="form-control @error('cv') text-danger @enderror" type="file" id="formFile" name="cv" accept=".pdf">
    @error('cv')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    Source :
    <input class="form-control" type="text" name="source" id="source" value="{{old('source')}}"><br>

    Observation :
    <textarea class="form-control" type="text" name="observation" id="observation" value="{{old('observation')}}"></textarea>

</div>

    <div class="btns mt-5 d-flex w-100 justify-content-around">
        <a class="btn btn-info" href="{{route('professionnels.index')}}">Retour</a>
        <button type="submit" class="btn btn-success">Valider l'ajout</button>
    </div>

</form>

@endsection