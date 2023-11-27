<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\EdasController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\DecisionMatrixController;
use App\Http\Controllers\SubcriteriaController;

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


Route::get('/', fn () => redirect()->route('login.get'));

Route::get('/login', [LoginController::class, 'index'])->name('login.get');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'index'])->name('register.get');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/sepuh', fn () => view('criterias.index'))->name('sepuh');

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', fn () => view('index'))->name('index');

    Route::get('/index/data', [EdasController::class, 'fetchData'])->name('fetchDataIndex');

    Route::get('/edas/data', [EdasController::class, 'fetchEdas'])->name('fetchDataEdas');

    Route::resource('edas', EdasController::class)->except(['show', 'create']);

    Route::resource('criteria', CriteriaController::class)->except(['index', 'create']);

    Route::get('/criteria/data/{id_edas}', [CriteriaController::class, 'fetchData'])->name('fetchDataCriteria');

    Route::resource('alternative', AlternativeController::class)->except(['index', 'create']);

    Route::get('/alternative/data', [AlternativeController::class, 'fetchData'])->name('fetchDataAlternative');

    Route::resource('decisionmatrix', DecisionMatrixController::class)->except(['index', 'create']);

    Route::get('/decisionmatrix/data', [DecisionMatrixController::class, 'fetchData'])->name('fetchDataDecisionMatrix');

    Route::resource('subcriteria', SubcriteriaController::class)->except(['index', 'create']);

    Route::get('/subcriteria/data/{id_edas}', [SubcriteriaController::class, 'fetchData'])->name('fetchDataSubcriteria');

    Route::resource('alternative', AlternativeController::class)->except(['index', 'create']);

    Route::get('/alternative/data/{id_edas}', [AlternativeController::class, 'fetchData'])->name('fetchDataAlternative');
});
