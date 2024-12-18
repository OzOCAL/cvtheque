{{-- Directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenu de la section qui suit.
    Le lien est réalisé avec la directive @yield --}}

@section('contenu')

<div class="d-flex justify-content-between">
    <a class="ms-auto col-lg-3 btn btn-success" href="{{route('competences.create')}}">Créer une compétence</a>
    @if(session('information'))
    <div class="alert alert-dismissible alert-success">
        <h4 class="alert-heading">Information :</h4>
        <p class="m-0">{{session('information')}}</p>
    </div>
    @endif
</div>

<h2>Liste des compétences</h2>
<!-- Formulaire de recherche -->
<form method="GET" action="{{ route('competences.index') }}" class="mb-3">
    <div class="input-group">
        <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="Rechercher une compétence" 
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
</form>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Intitulé</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($competences as $competence)
        <tr>
            <td>{{$competence->id}}</td>
            <td><strong>{{$competence->intitule}}</strong></td>
            <td>
                <form action="{{ route('competences.show', $competence->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <button type="submit" class="btn btn-primary">Consulter</button>
                </form>
            </td>
            <td>
                <form action="{{ route('competences.edit', $competence->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <button type="submit" class="btn btn-info">Modifier</button>
                </form>
            </td>
            <td>
                <form action="{{ route('competences.destroy', $competence->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection