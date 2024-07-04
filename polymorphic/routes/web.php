<?php

use Illuminate\Support\Facades\Route;
use App\Models\Photo;
use App\Models\Staff;
use App\Models\Product;
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

Route::get('/create', function () {
    $product = Product::findOrFail(1);

    $product->photos()->create(['path'=>'example.jpg']);
});


Route::get('/read', function () {
    $product = Product::findOrFail(1);
    echo $product->photos->first()->path;
});

Route::get('/update', function () {
    $product = Product::findOrFail(1);
    $photo = $product->photos()->first();
    $photo->path = 'example2.jpg';
    $photo->save();
    return $photo;
});

Route::get('/delete', function () {  
    $product = Product::findOrFail(1);
    $photo = $product->photos()->first();
    $photo->delete();
    return $photo;
});

Route::get('/assign', function () { 
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(2);
    $staff->photos()->save($photo);
    return $staff->photos;
});


Route::get('/unassign', function () { 
    $staff = Staff::findOrFail(1);
    // $photo = Photo::findOrFail(2)->update(['imageable_type'=> '','imageable_id'=>'']);
    $staff->photos()->where('id','2')->update(['imageable_type'=> '','imageable_id'=>0]);
    // return $staff->photos;
});