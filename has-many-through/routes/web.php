<?php

use Illuminate\Support\Facades\Route;
use App\Models\Country;
use App\Models\tweet;
use App\Models\video;
use App\Models\comment;
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

Route::get('/country/{id}', function ($id) {
    $country = Country::find($id);
    //echo $country->posts;
    echo "bellow are posts\n";
    foreach($country->posts as $post) {
        echo $post."\n";
    }
});

Route::get("/comments/{tweetId}/{body}", function ($tweetId,$body) {
    $tweet = Tweet::find($tweetId);

    $comment = $tweet->comments()->create(["body"=> $body]);

    return $comment;
});

Route::get("/videos/{videoId}/{body}", function ($videoId,$body) {
    $tweet = Video::find($videoId);

    $comment = $tweet->comments()->create(["body"=> $body]);

    return $comment;
});