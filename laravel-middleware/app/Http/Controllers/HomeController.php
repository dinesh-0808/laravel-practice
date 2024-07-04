<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // $request->session()->put(["dinesh" =>"choudhari"]);
        // this is a global session function to set session
        // session(["ramesh"=>["choudhari"]]);
        // $request->session()->forget('ramesh');

        // session()->flash("achalaram ","choudahri");


        return $request->session()->all();
    }
}
