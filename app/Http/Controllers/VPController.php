<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VPController extends Controller
{
    //

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:admin');
       $this->middleware('VP');
      
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('admin.vp');
         return view('admin.vp',array('user'=> Auth::user()));
    }
}
