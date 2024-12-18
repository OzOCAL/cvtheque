<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetierRequest;
use Illuminate\Http\Request;

use App\Models\{
    Metier,
};

class MetierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metiers = Metier::all();

        $data = [
            'titre' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des métiers de la ' . config('app.name'),
            'metiers' => $metiers,
        ];
        return view('metiers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metiers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetierRequest $metierRequest)
    {
        $metier = new Metier;
        $metier->libelle = $metierRequest->libelle;
        $metier->description = $metierRequest->description;
        $metier->slug = $metierRequest->slug;
        $metier->save();

        $msg = "Enregistrement réussi.";
        return redirect()->route('metiers.index')->withInformation($msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Metier $metier)
    {
        $data = [
            'titre' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des métiers de la ' . config('app.name'),
            'metier' => $metier,
        ];

        return view('metiers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metier $metier)
    {
        $data = [
            'titre' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des métiers de la ' . config('app.name'),
            'metier' => $metier,
        ];

        return view('metiers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetierRequest $metierRequest, Metier $metier)
    {
        $valideData = $metierRequest->all();
        $metier->update($valideData);

        $msg = "Métier modifié avec succès.";
        return redirect()->route('metiers.index')->withInformation($msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Metier $metier)
    {
        $metier->delete();

        return back()->withInformation('Le métier a été supprimé avec succès.');
    }
}
