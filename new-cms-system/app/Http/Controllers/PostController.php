<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    //

    public function index(){
        $user = Auth::user();

        $posts = $user->posts()->paginate(5);
        // $posts = Post::paginate(5); 
        return view('admin.posts.index',compact('posts'));
    }
    public function show($id) {
        $post = Post::findOrFail($id);
        return view("blog-post",compact("post"));
    }

    public function create(){
        $user = Auth::user();

        return view("admin.posts.create",compact("user"));
    }

    public function store(Request $request){  
        request()->validate([
            "title"=> "required|min:8|max:255",
            "post_image"=>'file',
            'body'=>'required'
        ]);  
        $user = Auth::user();
        $info = $request->all();
        $post = new Post();
        $post->user_id = $user->id;
        $post->title = $info["title"];
        $post->body = $info["body"];
        if(array_key_exists('post_image', $info)){
            $file = $info['post_image']; 
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $post->image = "/images/".$name;

        }
        $post->save();
        Session::flash("post-created-message","post created successfully");
        return redirect("/admin/post")->with("success","post created successfully");

    }


    public function destroy(string $id)
    {
        
        $post = Post::findOrFail($id);
        // dd($post);
        $post->delete();
        Session::flash("post-deleted-message","post was deleted");
        return redirect("/admin/post")->with("success","post deleted successfully");
        // return view('temp');
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        $this->authorize("view", $post);
        return view('admin.posts.edit',compact('post')); 
    }

    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $this->authorize('update',$post);
        $post->title = $request->title;
        $post->body = $request->body;
        if($file = $request->post_image){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $post->image = '/images/'.$name;
        }
        $post->save();
        Session::flash("post-created-message","post updated successfully");
        return redirect('/admin/post')->with('success','post updated successfully');
    }
}
