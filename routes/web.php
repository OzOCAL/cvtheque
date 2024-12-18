<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{

    CvthequeController,
    CompetenceController,
    MetierController,
    ProfessionnelController,
};
use App\Models\Professionnel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[CvthequeController::class,'index'])->name('accueil');
Route::get('/competences', [CompetenceController::class, 'index'])->name('competences.index');
Route::resource('competences', CompetenceController::class);
Route::resource('metiers', MetierController::class);


Route::get('/metier/{slug}/professionnels',[ProfessionnelController::class, 'index'])->name('professionnels.metier');
Route::resource('professionnels', ProfessionnelController::class);
Route::get('/professionnels/{professionnel}/delete', [ProfessionnelController::class, 'delete'])->name('professionnels.delete');




/* Route::get('/', function () {
    // return view('welcome');
    return view('cvtheque');
}); */
