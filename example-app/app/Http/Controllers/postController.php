<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postController extends Controller
{
    //
    public function index($name,$id) {

        //two methods
        // return view("post")->with('name',$name)->with('id',$id);
        return view("post",compact("name","id"));
    }

    public function post() {

        


        return view("post");
    }

    public function contact(){
        $people = ['dinesh','sfdsdf','sfsdfsdf','sdfdsf'];
        return view("contact",compact("people"));
    }
}
