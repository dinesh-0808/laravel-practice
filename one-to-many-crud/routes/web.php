<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Account;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert/{user_id}/{account}', function ($user_id,$account_name) {
    $user = User::findOrFail($user_id);
    $account = new Account();
    $account->user_id = $user->id;
    $account->name = $account_name;
    $account->save();
    return $account;
});

Route::get('/update/{user_id}/{account_id}/{account_name}', function ($user_id,$account_id, $account_name) {
    $user = User::findOrFail($user_id);
    $account = $user->accounts()->where('id', $account_id)->first();
    $account->name = $account_name;
    $account->save();
    return $account;
});

Route::get('/retrieve/{user_id}', function ($user_id){
    $user = User::findOrFail($user_id);
    return $user->accounts;
});

Route::get('/delete/{user_id}/{account_id}', function ($user_id,$account_id) {
    $user = User::findOrFail($user_id);
    $account = $user->accounts()->where('id', $account_id)->first();
    $account->delete();
    return $account;
});

