<?php

use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/insert',function() {
    DB::insert('insert into posts (title,content) values(?,?);',["Intro to PHP ","LARAVEL is MVC Framework"]);
});

Route::get("/display",function() {
    $result = DB::select("select * from posts");

    return $result;
});


Route::get("/update",function() {

    $updated = DB::update('update posts set title="PHP and laravel" where id=?',[1]);
});

Route::get('/delete',function() {
    $deleted = DB::delete('delete from posts where id=?',[2]);
    return $deleted;
});


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


// Route::get('/user/{name}/{id}', function ($name, $id) {
//     return "user name is ".$name." and id is ".$id;
// });


// naming the url
Route::get('/admin/post/example',function(){
    $url = route('admin.home');

    return "my url is ".$url;
})->name('admin.home');



// controller route new version -----------------------------------------------
// Route::get('/posts/{name}/{id}',[postController::class,'index']);

// older version
// Route::get('/posts','postController@index');

// resource route
// Route::resource('/posts',postController::class);

// passing the data to the view and how it is displayed here index is function in postController
// Route::get('/post/{name}/{id}',[postController::class,'index']);


Route::get('/post',[postController::class,'post']);
Route::get('/contact',[postController::class,'contact']);









/*
|--------------------------------------------------------------------------
| Eloquent - ORM
|--------------------------------------------------------------------------
*/

Route::get('/show',function(){
    $posts = Post::all();

    $post = Post::findOrFail(3);


    return $post;
});

Route::get('/showwhere',function(){
    $posts = Post::where('title','Intro to PHP')->orderby('id','desc')->take(1)->get();

    foreach ($posts as $post) {
        echo($post);
    }
});


Route::get('/findmore',function(){
    // $post = Post::findorfail('2');

    $post = Post::where('id','<',5)->firstOrFail();
    return $post;
});

Route::get('/basicinsert',function(){
    $post = Post::find(1);
    $post->title = 'Php wiht Eloquent';
    $post->content= 'content here';

    $post->save();
});

Route::get('/insertmass',function(){
    Post::create(['title'=> 'fgfdgfd','content'=> 'ghfgdh']);
    // make title and content fillable in model
});

Route::get('/basicupdate',function(){
    Post::where('id',3)->update(['title'=> 'updated elquent title','content'=> 'updated elquent content']);
});

Route::get('/basicdelete',function(){
    $post = Post::find(5);
    $post->delete();

});


Route::get('/softdelete',function(){
    Post::find(3)->delete();
});

Route::get('/readsoftdelete',function(){
    //all records including soft deletes
    // $softDeltePosts = Post::withTrashed()->get();

    // only soft deletes
    $softDeltePosts = Post::onlyTrashed()->get();

    return $softDeltePosts;
});

Route::get('/restoresoftdelete',function(){ 

    Post::onlyTrashed()->restore();
});

Route::get('/forcedelete',function(){
    //soft delete
    Post::where('id',6)->delete();

    //permanent delete
    Post::where('id',4)->forceDelete();
});



/*
|--------------------------------------------------------------------------
| Eloquent - Relationships
|--------------------------------------------------------------------------
*/
//one to one example
Route::get('/user/{id}/post',function($id){
    $post = User::find($id)->post->content;
    return $post;
});
Route::get('/post/{id}/user',function($id){
    $user = Post::find($id)->user;
    return $user;
});

// one to many ex
Route::get('/posts/{id}',function($id){
    $user = User::find($id);
    foreach($user->posts as $post){
        echo $post->title;
    }
});

Route::get('/user/{id}',function($id){
    $user = Post::find($id)->user;
    return $user;

});


//many to many ex
Route::get('/user/{id}/roles',function($id){
    $roles = User::find($id)->roles;
    return $roles;
});

Route::get('users/pivot',function(){
    $user = User::find(1);

    foreach($user->roles as $role){
        echo $role->pivot;
    }
});