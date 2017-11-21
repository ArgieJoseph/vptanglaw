<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DirectorController extends Controller
{

  
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
       $this->middleware('Director');
      
    }


     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('admin.director');
         return view('admin.director',array('user'=> Auth::user()));
    }
}
