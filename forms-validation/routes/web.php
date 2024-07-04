<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route; 
use Carbon\Carbon;
use App\Models\User;
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

// Route::resource('posts',PostController::class);

Route::group(["middleware"=>'web'],function(){
    Route::resource('posts',PostController::class);

    Route::get('/dates',function(){
        $date = new DateTime('+1 week');

        echo $date->format('d-m-y')."<br>";

        echo Carbon::now()->addDays(15)->diffForHumans(); 
    });

    Route::get("/getname",function(){
        $user = User::findOrFail(1);

        echo $user->name;

    }); 

    Route::get("/setname",function(){
        $user = new User();

        $user->name = "ramesh";
        $user->email = "ramesh@one.com";
        $user->password = bcrypt("skldfjsdklf");
        $user->save();
    });

});