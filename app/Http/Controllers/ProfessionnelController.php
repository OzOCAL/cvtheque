<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Professionnel,
    Metier,
    Competence
};

use App\http\Requests\ProfessionnelRequest;

use Storage, Str;

class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $slug = null)
    {

        $search = $request->query('search');

        /* $professionnels = $slug ?
            Metier::where('slug', $slug)->firstOrFail()->professionnels()->get() :
            Professionnel::all(); */

            if ($slug) {
                $professionnels = Metier::where('slug', $slug)
                    ->firstOrFail()
                    ->professionnels()
                    ->when($search && strlen($search) >= 3, function ($query) use ($search) {
                        $query->where('nom', 'like', "%{$search}%")
                              ->orWhere('prenom', 'like', "%{$search}%");
                    })
                    ->paginate(15);
            } else {
                $professionnels = Professionnel::query()
                    ->when($search && strlen($search) >= 3, function ($query) use ($search) {
                        $query->where('nom', 'like', "%{$search}%")
                              ->orWhere('prenom', 'like', "%{$search}%");
                    })
                    ->paginate(15);
            }

        // Pour relation 1,n 1,n Professionnel / Competence
        $metiers = Metier::all();

        $data = [
            'titre' => "Les professionnels de la " . config('app.name'),
            'description' => 'Retrouvez les professionnels de la ' . config('app.name'),
            'professionnels' => $professionnels,
            'metiers' => $metiers,
            'slug' => $slug,
            'search' => $search,
        ];

        return view('professionnels.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $metiers = Metier::orderBy('libelle')->get();
        $competences = Competence::orderBy('intitule')->get();


        $data = [
            'titre' => "Les professionnels de la " . config('app.name'),
            'description' => 'Retrouvez les professionnels de la ' . config('app.name'),
            'metiers' => $metiers,
            'competences' => $competences,
        ];

        return view('professionnels.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionnelRequest $professionnelRequest)
    {
        $validData = $professionnelRequest->all();
        $validData['domaine'] = implode(',', $professionnelRequest->input('domaine'));

        $nouveauProfessionnel = Professionnel::create($validData);

        if ($professionnelRequest->hasFile('cv')) {
            $extension = $professionnelRequest->file('cv')->extension();

            $fileName = Str::slug($nouveauProfessionnel->nom).'_'. $nouveauProfessionnel->id. '.' . $extension;
            $filePath = $professionnelRequest->file('cv')->storeAs('cv/'. $nouveauProfessionnel->id, $fileName);
            $nouveauProfessionnel->cv =$filePath;
            $nouveauProfessionnel->save();
        }

        $nouveauProfessionnel->competences()->attach($professionnelRequest->competences);

        $msg = "Professionnel créé.";
        return redirect()->route('professionnels.index')->withInformation($msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Professionnel $professionnel)
    {

        $domaines = [
            'S' => 'Systèmes',
            'R' => 'Réseaux',
            'D' => 'Développement'
        ];

        $domainesActifs = array_filter(
            explode(',', $professionnel->domaine),
            fn($d) => isset($domaines[$d])
        );

        $competences = $professionnel->competences->pluck('intitule')->toArray();

        $professionnel->domaine = implode(', ', array_map(fn($d) => $domaines[$d], $domainesActifs));

        $data = [
            'titre' => "Consulter un professionnel",
            'professionnel' => $professionnel,
            'competences' => implode(', ', $competences),
        ];

        return view('professionnels.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professionnel $professionnel)
    {
        $metiers = Metier::orderBy('libelle')->get();

        $competences = Competence::orderBy('intitule')->get();

        $data = [
            'titre' => 'Modifier un professionnel',
            'professionnel' => $professionnel,
            'metiers' => $metiers,
            'competences' => $competences
        ];

        return view('professionnels.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionnelRequest $professionnelRequest, Professionnel $professionnel)
    {
        $validData = $professionnelRequest->all();
        $validData['domaine'] = implode(',', $professionnelRequest->input('domaine'));

        if ($professionnelRequest->hasFile('cv')) {
            $extension = $professionnelRequest->file('cv')->extension();

            $fileName = Str::slug($professionnelRequest->nom).'_'. $professionnel->id. '.' . $extension;
            $filePath = $professionnelRequest->file('cv')->storeAs('cv/'. $professionnel->id, $fileName);
            $professionnel->cv = $filePath;

            $validData['cv'] = $filePath;
        }

        $professionnel->update($validData);
        // Pour relation avec table pivot (1-n, 1-n)
        $professionnel->competences()->sync($professionnelRequest->competences);

        $msg = "Professionnel modifié avec succès.";
        return redirect()->route('professionnels.index')->withInformation($msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professionnel $professionnel)
    {
        $professionnel->delete();

        return redirect()->route('professionnels.index')->withInformation('Le professionnel a été supprimé avec succès.');
    }

    public function delete(Professionnel $professionnel)
    {
        
        $data = [
            'titre' => 'Supprimer un professionnel',
            'professionnel' => $professionnel,
        ];
        

        return view('professionnels.delete', $data);
    }
}
