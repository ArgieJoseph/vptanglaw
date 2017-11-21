<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class VPPagesController extends Controller
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
       $this->middleware('VP',['only' => ['vp_index','vp_enrollment','vp_graduates','vp_scholarship','vp_administrative','vp_finance','vp_licensure','vp_faculty','vp_appendices','vp_facility']]);
      
    }


      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_index()
    {
        //return view('pages.vp_index');
         return view('pages.vp_index',array('user'=> Auth::user()));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_enrollment()
    {
        //for table
        $t_loc = DB::table('t_enrollments')
            ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
                ->join('universities  as u', 'tu.u_id', '=', 'u.id')
                    ->select( DB::raw('UCASE(u.address) as Address'))
                        ->groupBy('Address')->orderBy('course')->get();

//for table
    $t_univ = DB::table('t_enrollments')
        ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
            ->join('universities  as u', 'tu.u_id', '=', 'u.id')
                ->select('tu.major', DB::raw('UCASE(u.address) as Address'),'tu.course',
                    DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale) as Male,  SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as Female,
                         SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as total, ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)),2)*100 as malepercent, ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)),2)*100 as femalepercent'))
                            ->groupBy('Address','tu.major')
                                ->orderBy('Address')
                                    ->get();

//for table
    $t_total = DB::table('t_enrollments')->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')->join('universities  as u', 'tu.u_id', '=', 'u.id')->select( DB::raw('UCASE(u.address) as Address, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale) as Male, SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as Female, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as Total'))->groupBy('Address')->orderBy('course')->get();
//----------

//for chart
        $result = DB::table('t_enrollments')->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')->join('universities  as u', 'tu.u_id', '=', 'u.id')->select( DB::raw('UCASE(u.address) as Address, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as total'))->groupBy('Address')->orderBy('course')->get()->toArray();
        

//for chart
        $result_univ = DB::table('t_enrollments')->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')->join('universities  as u', 'tu.u_id', '=', 'u.id')->select( DB::raw('UCASE(u.address) as Address1'),'tu.course',DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale) as Male, SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as Female, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as total, ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)),2)*100 as malepercent, ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)),2)*100 as femalepercent'))->groupBy('Address','tu.course')->orderBy('Address')->get();


//for chart
    $result_major = DB::table('t_enrollments')->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')->join('universities  as u', 'tu.u_id', '=', 'u.id')->select('tu.major', DB::raw('UCASE(u.address) as Address'),'tu.course',DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale) as Male, SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as Female, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale) as total, ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)),2)*100 as malepercent, ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)),2)*100 as femalepercent'))->groupBy('Address','tu.major')->orderBy('Address')->get();



 /*       dd($result_major);
        dd($result_univ);
        dd($t_univ);
*/
        return view('pages.vp_enrollment',compact('t_univ','t_loc','t_total','result','result_univ','result_major' ),array('user' => Auth::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_graduates()
    {
        //return view('pages.vp_graduates');
        return view('pages.vp_graduates',array('user' => Auth::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_scholarship()
    {
        //return view('pages.vp_scholarship');
        return view('pages.vp_scholarship',array('user' => Auth ::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_licensure()
    {
       // return view('pages.vp_licensure');
        return view('pages.vp_licensure',array('user' => Auth ::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_faculty()
    {
       // return view('pages.vp_faculty');
        return view('pages.vp_faculty',array('user' => Auth ::user()));
    }
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_administrative()
    {
        //return view('pages.vp_administrative');
        return view('pages.vp_administrative',array('user' => Auth ::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_finance()
    {
       // return view('pages.vp_finance');
        return view('pages.vp_finance',array('user' => Auth ::user()));
    }
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_facility()
    {
       //return view('pages.vp_facility');
        return view('pages.vp_facility',array('user' => Auth ::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vp_appendices()
    {
        //return view('pages.vp_appendices');
        return view('pages.vp_appendices',array('user' => Auth ::user()));
    }

    
}

