<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankasController;
use App\Http\Controllers\CalcController as C;
use App\Http\Controllers\ClientController as CL;
use App\Http\Controllers\OrderController as ORD;
use App\Http\Controllers\TownController as TW;
use App\Http\Controllers\AccountController as AC;

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

Route::prefix('orders')->name('orders-')->group(function () {
    Route::get('/', [ORD::class, 'index'])->name('index');
    Route::get('/create', [ORD::class, 'create'])->name('create');
    Route::post('/create', [ORD::class, 'store'])->name('store');
    Route::get('/{order}', [ORD::class, 'show'])->name('show');
    Route::get('/edit/{order}', [ORD::class, 'edit'])->name('edit');
    Route::put('/edit/{order}', [ORD::class, 'update'])->name('update');
    Route::delete('/delete/{order}', [ORD::class, 'destroy'])->name('delete');
});

Route::prefix('towns')->name('towns-')->group(function () {
    Route::get('/', [TW::class, 'index'])->name('index');
    Route::get('/create', [TW::class, 'create'])->name('create');
    Route::post('/create', [TW::class, 'store'])->name('store');
    Route::get('/{town}', [TW::class, 'show'])->name('show');
    Route::get('/edit/{town}', [TW::class, 'edit'])->name('edit');
    Route::put('/edit/{town}', [TW::class, 'update'])->name('update');
    Route::delete('/delete/{town}', [TW::class, 'destroy'])->name('delete');
});

Route::prefix('accounts')->name('accounts-')->group(function () {
    Route::get('/', [AC::class, 'index'])->name('index');
    Route::get('/create', [AC::class, 'create'])->name('create');
    Route::post('/create', [AC::class, 'store'])->name('store');
    Route::get('/{account}', [AC::class, 'show'])->name('show');
    Route::get('/edit/{account}', [AC::class, 'edit'])->name('edit');
    Route::put('/edit/{account}', [AC::class, 'update'])->name('update');
    Route::delete('/delete/{account}', [AC::class, 'destroy'])->name('delete');
});



Route::get('/sum/{a}/{b?}', [BankasController::class, 'sum']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');