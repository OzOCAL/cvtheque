<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
        Competence,
    };

use App\Http\Requests\CompetenceRequest;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->query('search');

        $competences = Competence::query()
            ->when($search, function ($query, $search) {
                $query->where('intitule', 'like', "%{$search}%");
        })
        ->orderBy('intitule')
        ->get();


        // $competences = Competence::all();

        $data = [
            'titre' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des compétences de la ' . config('app.name'),
            'competences' => $competences,
        ];
        return view('competences.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('competences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompetenceRequest $competenceRequest)
    {
        //$valideData = $competenceRequest->all();
        // dd($valideData);
        //Competence::create($valideData);
        //$msg = "Enregistrement réussi.";
        //return redirect()->route('competences.index')->withInformation($msg);

        $competence = new Competence;
        $competence->intitule = $competenceRequest->intitule;
        $competence->description = $competenceRequest->description;
        $competence->save();

        $msg = "Enregistrement réussi.";
        return redirect()->route('competences.index')->withInformation($msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
        $data = [
            'titre' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des compétences de la ' . config('app.name'),
            'competence' => $competence,
        ];

        return view('competences.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
        $data = [
            'titre' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retourner l\'ensemble des compétences de la ' . config('app.name'),
            'competence' => $competence,
        ];

        return view('competences.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompetenceRequest $competenceRequest, Competence $competence)
    {
        $valideData = $competenceRequest->all();
        $competence->update($valideData);

        $msg = "Enregistrement de la modification effectuée";
        return redirect()->route('competences.index')->withInformation($msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();

        return back()->withInformation('La compétence est supprimée.');
    }
}
