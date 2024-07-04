<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\IsAdminMiddleware;
class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware(IsAdminMiddleware::class);
    }

    public function index(){  
        echo "you are an administrator";
    }
}
