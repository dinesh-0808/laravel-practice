<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

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

Route::get('/insert/{user_id}/{role}', function ($user_id,$role_name) {
    $user = User::findOrFail($user_id);


    $role = new Role();
    $role->name = $role_name;
    $role->user_id = $user_id; 
    // $role->save();
    $user->roles()->save($role);

    return $role;
});

Route::get('/read/{user_id}', function ($user_id) {
    $user = User::findOrFail($user_id);
    // foreach ($user->roles as $role) {
        dd($user->roles);
    // }
});

Route::get('/update/{user_id}', function ($user_id) {
    $user = User::findOrFail($user_id);

    if($user->has('roles')){
        foreach($user->roles as $role){
            if($role->name == 'doctor'){
                $role->name = 'Doctor';
                $role->save();
            }
        }
    }
});

Route::get('/delete/{user_id}', function ($user_id) {
    $user = User::findOrFail($user_id);
    if($user->has('roles')){
        foreach($user->roles as $role){
            if($role->name == 'Doctor'){
                $role->delete();
            }
        }
    }
});

Route::get('/attach', function () {
    $user = User::findOrFail(2);
    $user->roles()->attach(8);
});

Route::get('/deattach', function () {
    $user = User::findOrFail(2);
    $user->roles()->detach(8);
});