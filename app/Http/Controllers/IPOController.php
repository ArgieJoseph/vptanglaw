<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IPOController extends Controller
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
       $this->middleware('IPO');
      
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return view('ipo');
         return view('admin.ipo',array('user'=> Auth::user()));
    }
}
