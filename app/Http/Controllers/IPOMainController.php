<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Universities;
use Illuminate\Support\Facades\Input;
use DB;
use App\Enrollment;
use App\TEnrollment;
use App\Semester;
use App\SchoolYear;
use App\FacultyAcadrankFt;

class IPOMainController extends Controller
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
    public function facility(Request $request)
    {
         
        $branch= DB::table('universities')
            ->pluck('name','id');

          return view('pages.ipo_import_facility',compact('semester','sy','branch'),array('user'=> Auth::user()));
    }





 




}
