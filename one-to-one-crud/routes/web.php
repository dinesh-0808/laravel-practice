<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Address;
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

Route::get('/insert', function () {
    $user = User::findOrFail((1));
    $address = new Address();
    $address->user_id = $user->id;
    $address->name = "tara emarald";
    $user->address()->save($address);
    return $address;
});

Route::get("/update/{id}", function ($id) {
    $user = User::findOrFail($id);
    
    // $address = Address::whereUserId($id)->first();
    $address = $user->address;
    $address->name = "updated address tara emarald";
    $address->save();
    
    return $address;

});

Route::get("/retrive/{id}", function ($id) {
    $user = User::findOrFail($id);
    $address = $user->address;
    return $address;
});

Route::get("/delete/{id}", function ($id) {
    $user = User::findOrFail($id);
    $address = $user->address;
    $address->delete();

    return $address;

});