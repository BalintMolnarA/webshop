<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;



Route::get('/', function () {
    $kategoriak = DB::select("SELECT kategoriak.nev, urlek.url FROM 
    kategoriak INNER JOIN urlek ON (kategoriak.k_id=urlek.kapscolat) WHERE urlek.tipus='kategoria'");
    return view("welcome",["kategoriak"=>$kategoriak]);
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
