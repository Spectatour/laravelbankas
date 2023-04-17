<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankasController;
use App\Http\Controllers\CalcController as C;
use App\Http\Controllers\ClientController as CL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/labas', fn() => '<h1 style="color:crimson;">LABAS</h1>');


Route::prefix('labas')->group(function () {

    Route::get('/briedi', [BankasController::class, 'hello'])->name('briedis');
    Route::get('/vovere', [BankasController::class, 'helloV']);
    Route::get('/{animal}', [BankasController::class, 'helloAnimal']);
    Route::get('/{animal}/{color}/color', [BankasController::class, 'helloFancy'])->name('fancy');

});


Route::get('calc', [C::class, 'show'])->name('show');
Route::post('calc', [C::class, 'doCalc'])->name('do-calc');


Route::prefix('clients')->name('clients-')->group(function () {
    Route::get('/', [CL::class, 'index'])->name('index');
    Route::get('/create', [CL::class, 'create'])->name('create');
    Route::post('/create', [CL::class, 'store'])->name('store');
    Route::get('/{client}', [CL::class, 'show'])->name('show');
    Route::get('/edit/{client}', [CL::class, 'edit'])->name('edit');
    Route::put('/edit/{client}', [CL::class, 'update'])->name('update');
    Route::get('/editAdd/{client}', [CL::class, 'editAdd'])->name('editAdd');
    Route::put('/editAdd/{client}', [CL::class, 'updateAdd'])->name('updateAdd');
    Route::get('/editWithdraw/{client}', [CL::class, 'editWithdraw'])->name('editWithdraw');
    Route::put('/editWithdraw/{client}', [CL::class, 'updateWithdraw'])->name('updateWithdraw');
    
    Route::delete('/delete/{client}', [CL::class, 'destroy'])->name('delete');
});




Route::get('/sum/{a}/{b?}', [BankasController::class, 'sum']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');