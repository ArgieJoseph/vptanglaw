<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class IPOCampusController extends Controller
{
    //
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
        //return view('pages.admin_program_technical');
          return view('pages.ipo_import_campus',array('user'=> Auth::user()));
    }
}
