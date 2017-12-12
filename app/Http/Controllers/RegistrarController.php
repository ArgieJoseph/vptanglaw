<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RegistrarController extends Controller
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
       $this->middleware('Registrar');
       
      
    }
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('admin.registrar');
         return view('admin.registrar',array('user'=> Auth::user()));
    }

 
}
