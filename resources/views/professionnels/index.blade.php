{{-- Directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenu de la section qui suit.
    Le lien est réalisé avec la directive @yield --}}

@section('contenu')
<div class="d-flex justify-content-between">
    <form action="{{ $slug ? route('professionnels.index', ['slug' => $slug]) : route('professionnels.index') }}" method="GET">
        <div class="input-group mb-3">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Rechercher un professionnel (nom, prénom, email)" 
                value="{{ request('search') }}"
                minlength="3"
            >
            <input type="hidden" name="slug" value="{{ $slug }}">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>
    
    <select onchange="location.href=this.value" class="col-lg-3">
        <option value="{{route('professionnels.index')}}" @unless($slug) selected @endunless>
            Tous les professionnels
        </option>
        @foreach($metiers as $metier)
        <option value="{{route('professionnels.metier', ['slug' => $metier->slug])}}" {{($slug == $metier->slug) ? 'selected' : ''}}>{{$metier->libelle}}</option>     
        @endforeach
    </select>
    <a class="col-lg-3 btn btn-success" href="{{route('professionnels.create')}}">Ajouter un professionnel</a>
</div>
@if(session('information'))
<div class="alert alert-dismissible alert-success">
    <h4 class="alert-heading">Information :</h4>
    <p class="m-0">{{session('information')}}</p>
</div>
@endif
<h2>{{ $titre }}</h2>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>NOM Prénom</th>
            <th>Métier</th>
            <th>Domiciliation</th>
            <th>Formation</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($professionnels as $professionnel)
        
        <tr>
            <td>{{$professionnel->id}}</td>
            <td><strong>{{$professionnel->nom}} {{$professionnel->prenom}}</strong></td>
            <td>{{$professionnel->metier->libelle}}</td>
            <td>{{$professionnel->cp}} {{$professionnel->ville}}</td>
            <td>@if ($professionnel->formation == 0) NON @else OUI @endif</td>
            <td>
                <form action="{{ route('professionnels.show', $professionnel->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <button type="submit" class="btn btn-primary">Consulter</button>
                </form>
            </td>
            <td>
                <form action="{{ route('professionnels.edit', $professionnel->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <button type="submit" class="btn btn-info">Modifier</button>
                </form>
            </td>
            <td>
                <form action="{{ route('professionnels.delete', $professionnel->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <input type="hidden" name="libelle" value="{{$professionnel->metier->libelle}}">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<footer class="pagination justify-content-center p-lg-5">
    {{ $professionnels->links() }}
</footer>

@endsection