<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    use HasFactory;

    protected $fillable =[
        'prenom', 'nom', 'cp', 'ville', 'tel', 'email', 'naissance', 'formation', 'domaine', 'cv', 'source', 'observation', 'metier_id'
    ];

    function metier(){
        return $this->belongsTo(Metier::class);
    }

    /**
     * Un professionnel (model) possède plusieurs (belongsToMany) compétences
     * Récupération de toutes les compétences de tel professionnel
    */

    function competences(){
        return $this->belongsToMany(Competence::class)->withTimestamps();
    }
}
