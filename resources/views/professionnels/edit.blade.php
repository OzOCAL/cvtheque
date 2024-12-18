@extends('cvtheque')

@section('contenu')

<h2>{{$titre}}</h2>
<form class="infos" method="POST" action="{{route('professionnels.update', ['professionnel'=>$professionnel->id])}}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    Nom :
    <input class="form-control @error('nom') is-invalid @enderror" type="text" name="nom" id="nom" value="{{$professionnel->nom}}"><br>
    @error('nom')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Prénom :
    <input class="form-control @error('prenom') is-invalid @enderror" type="text" name="prenom" id="prenom" value="{{$professionnel->prenom}}"><br>
    @error('prenom')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Date de naissance :
    <input class="form-control @error('naissance') is-invalid @enderror" type="date" name="naissance" id="naissance" value="{{$professionnel->naissance}}"><br>
    @error('naissance')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Code postal :
    <input class="form-control @error('cp') is-invalid @enderror" type="text" name="cp" id="cp" value="{{$professionnel->cp}}"><br>
    @error('cp')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Ville :
    <input class="form-control @error('ville') is-invalid @enderror" type="text" name="ville" id="ville" value="{{$professionnel->ville}}"><br>
    @error('ville')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Téléphone :
    <input class="form-control @error('tel') is-invalid @enderror" type="text" name="tel" id="tel" value="{{$professionnel->tel}}"><br>
    @error('tel')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Email :
    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{$professionnel->email}}"><br>
    @error('email')
    <p class="text-danger" role="alert">{{$message}}</p>
    @enderror
    Formation :
    <input @error('formation') is-invalid @enderror type="radio" name="formation" id="formation" value="1" @if ($professionnel->formation == '1') checked @endif> Oui
    <input @error('formation') is-invalid @enderror" type="radio" name="formation" id="formation" value="0" @if ($professionnel->formation == '0') checked @endif> Non<br>
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
            {{ in_array('S', explode(',', $professionnel->domaine)) ? 'checked' : '' }}
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
            {{ in_array('R', explode(',', $professionnel->domaine)) ? 'checked' : '' }}
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
            {{ in_array('D', explode(',', $professionnel->domaine)) ? 'checked' : '' }}
            class="form-check-input @error('domaine') is-invalid @enderror"
        >
        <label for="domaine_d" class="form-check-label">Développement</label>
    </div>
    @error('domaine')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    CV :
    <input class="form-control @error('cv') text-danger @enderror" type="file" id="formFile" name="cv" accept=".pdf">
    @error('cv')
    <p class="text-danger">{{ $message }}</p>
    @enderror

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
    <select name="metier_id" class="form-select" @error('metier_id') is-invalid @enderror>

        @foreach($metiers as $metier)
        <option value="{{$metier->id}}" @if('metier_id' == $metier->id) selected @endif>{{$metier->libelle}}</option>
        @endforeach
    </select>
    @error('metier_id')
    <p class="text-danger">{{ $message }}</p>
    @enderror

    Compétences :
    <select name="competences[]" class="form-select @error('competences') is-invalid @enderror" multiple>
        <option value="" disabled></option>
        @foreach($competences as $competence)
            <option value="{{$competence->id}}"
                @if(is_array(old('competences')) && in_array($competence->id, old('competences')))
                    selected
                @elseif($professionnel->competences->contains($competence->id))
                    selected
            @endif
                >
                {{$competence->intitule}}
            </option>
        @endforeach
    </select>
    @error('competences')
    <p class="text-danger">{{ $message }}</p>
    @enderror
    
    Source :
    <input class="form-control" type="text" name="source" id="source" value="{{$professionnel->source}}"><br>

    Observation :
    <textarea class="form-control" type="text" name="observation" id="observation">{{$professionnel->observation}}</textarea>

</div>

    <div class="btns mt-5 d-flex w-100 justify-content-around">
        <a class="btn btn-info" href="{{route('professionnels.index')}}">Retour</a>
        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
    </div>

</form>

@endsection