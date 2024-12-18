{{-- Directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- Directive de blade spécifiant l'injection du contenu de la section qui suit.
    Le lien est réalisé avec la directive @yield --}}

@section('contenu')

<a class="ms-auto col-lg-3 btn btn-success" href="{{route('metiers.create')}}">Créer un métier</a>
@if(session('information'))
<div class="alert alert-dismissible alert-success">
    <h4 class="alert-heading">Information :</h4>
    <p class="m-0">{{session('information')}}</p>
</div>
@endif
<h2>Liste des métiers</h2>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Libellé</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($metiers as $metier)
        
        <tr>
            <td>{{$metier->id}}</td>
            <td><strong>{{$metier->libelle}}</strong></td>
            <td>
                <form action="{{ route('metiers.show', $metier->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <button type="submit" class="btn btn-primary">Consulter</button>
                </form>
            </td>
            <td>
                <form action="{{ route('metiers.edit', $metier->id) }}" method="POST">
                    @method('GET')
                    @csrf
                    <button type="submit" class="btn btn-info">Modifier</button>
                </form>
            </td>
            <td>
                <div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#dltWorkMdl-{{$metier->id}}">Supprimer</button>
                </div>
            </td>
        </tr>
        {{-- MODALE DE SUPPRESSION --}}
        <div id="dltWorkMdl-{{$metier->id}}" class="modal fade" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div action="{{ route('metiers.destroy', $metier->id) }}" method="POST" class="modal-content">
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Supprimer un métier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Confirmer la suppression du métier '{{$metier->libelle}}' ?</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

@endsection