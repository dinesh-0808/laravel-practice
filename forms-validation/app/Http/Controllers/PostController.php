<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::where('user_id',1)->orderBy('id','asc')->get();
        // echo($posts);
        return view("posts.index", compact("posts"));
        // foreach ($posts as $post) {
        //     echo $post."\n";
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        //handling file
        // $file = $request->file('fileToUpload');
        // echo $file->getClientOriginalName()."<br>";
        // echo $file->getClientOriginalExtension() ."<br>";
        // echo $file->getSize() ."<br>";
        //
        // method 1
        // Post::create($request->all());

        //method 2

        // this is handled by createPostRequest 
        // $this->validate($request,[
        //     "title"=>"required",
        //     "content"=>"required"
        // ]);

        $post = new Post();
        $post->title = $request->title;
        $post->user_id = 1;
        $post->content = $request->content;
        if($file = $request->file("fileToUpload")){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $post->path = $name;
        }
        $post->save();
        // return "saved successfully";
        return redirect('/posts')->with('success','forms data inserted successfully');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->save();
        $posts = Post::where('user_id',1)->get();
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect('/posts');
    }
}
