<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

use App\Http\Controllers\Account;
use App\Http\Controllers\Home;

Route::get('/', [Home::class, 'index'])->name('home');

Route::middleware('auth')->group(function()
{
    Route::get('/account', [Account::class, 'index'])->name('account.index');
    Route::post('/account/deposit', [Account::class, 'deposit'])->name('account.deposit');
    Route::post('/account/withdraw', [Account::class, 'withdraw'])->name('account.withdraw');
});

require __DIR__.'/auth.php';
