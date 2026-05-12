<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get("/api/getMataPelajaran", [APIController::class, 'getMataPelajaran']);
Route::get("/api/getFase/{id_mapel}", [APIController::class, 'getFase']);
Route::get("/api/getElemen/{id_fase}", [APIController::class, 'getElemen']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/how-to-use', function () {
    return view('how-to');
});

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/buat-baru', [UserController::class, 'create'])->name('rpp.create');
    Route::post('/request/submit', [UserController::class, 'submitForm'])->name('form.submit');
    Route::get('/request/download/{id}/pdf', [UserController::class, 'PDFdownloadRPP'])->name('rpp.download.pdf');
    Route::get('/request/download/{id}/word', [UserController::class, 'WORDdownloadRPP'])->name('rpp.download.word');
    //Route::get('/request/view/{id}', [UserController::class, 'viewRPP'])->name('rpp.view');
    Route::post('/request/retry/{id}', [UserController::class, 'retryRPP'])->name('rpp.retry');
    Route::delete('/request/delete/{id}', [UserController::class, 'deleteRPP'])->name('rpp.destroy');


    Route::get('/riwayat', [UserController::class, 'getDataAntrian'])->name('antrian.list');
});


Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::middleware(['auth'])->group(function () {

    // Show editor
    Route::get('/dokumen/editor/{id}', [DokumenController::class, 'edit'])->name('rpp.view');

    // Update document
    Route::put('/dokumen/update/{id}', [DokumenController::class, 'update'])->name('dokumen.update');

    // Export PDF
    Route::get('/dokumen/export-pdf/{id}', [DokumenController::class, 'requestGenerateDocx'])->name('dokumen.export.pdf');
    // Export Word
    // Route::get('/dokumen/export-word/{id}', [DokumenEditorController::class, 'exportWord'])->name('dokumen.export.word');

});

//TEMP-ROUTE
Route::get('/getData', [UserController::class, 'tempCommand']);



require __DIR__.'/auth.php';
