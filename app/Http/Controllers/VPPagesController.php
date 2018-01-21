<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use PDF;
use Carbon;
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
       // return view('pages.vp_enrollment');
//FOR TABLE START
    $t_loc = DB::table('t_enrollments')
    ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->select('tu.education', DB::raw('UCASE(u.address) as Address'))
    ->groupBy('Address','tu.education')
    ->orderBy('course')->get();

    $t_univ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_STUDENT(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD))');

    $t_total =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_PER_CAMPUS_EDUC(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD))');

    $t_educ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_EDUC(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD))');
// END FOR TABLE
// FOR CHART START
    $result = DB::table('t_enrollments')->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->select( DB::raw('UCASE(u.address) as Address, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as total'))
    ->groupBy('Address')
    ->orderBy('course')
    ->get()->toArray();
        


    $result_univ = DB::table('t_enrollments')
    ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->select( DB::raw('UCASE(u.address) as Address1'),'tu.course',
              DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale) as Male,
                         SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as Female,
                         SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as total,

                         ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as malepercent,
                         ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as femalepercent'))
    ->groupBy('Address','tu.course')
    ->orderBy('Address')->get();



    $result_major = DB::table('t_enrollments')
    ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->select( DB::raw('UCASE(u.address) as Address'),'tu.course','tu.major',
            DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale) as Male,
                    
                    SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as Female, 
                    
                    SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as total,

                    ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as malepercent,
                    
                    ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as femalepercent'))
    ->groupBy('Address','tu.major')
    ->orderBy('Address')
    ->get();
//END FOR CHART


    return view('pages.vp_enrollment',compact('t_univ','t_loc','t_total','result','result_univ','result_major','t_educ' ),array('user' => Auth ::user()));
    }


    public function vp_enrollment_pdf()
    {
       // return view('pages.vp_enrollment');

    $t_loc = DB::table('enrollments')
    ->join('t_universities  as tu', 'enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->select('tu.education', DB::raw('UCASE(u.address) as Address'))
    ->groupBy('Address','tu.education')
    ->orderBy('course')->get();

    $t_univ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_STUDENT(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD))');

    $t_total =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_PER_CAMPUS_EDUC(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD))');

    $t_educ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_EDUC(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD))');
/*
    $pdf= PDF::loadView('pages.vp_enrollment_pdf',compact('t_univ','t_loc','t_total','t_educ' ),array('user' => Auth ::user()));
    return $pdf->download('enrollment.pdf');
*/

    
    return view('pages.vp_enrollment_pdf',compact('t_univ','t_loc','t_total','t_educ' ),array('user' => Auth ::user()));
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */ 

    public function vp_graduates()
    {
        //return view('pages.vp_graduates');
        return view('pages.vp_graduates',array('user' => Auth ::user()));
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

        //FOR TABLE START
        // $t_loc2 = DB::table('scholarships')
        // ->join('t_universities as tu', 'scholarships.tu_id', '=', 'tu.id')
        // ->join('universities as u', 'tu.u_id', '=', 'u.id')
        // ->select('tu.education', DB::raw('UCASE(u.address) as Address'))
        // ->groupBy('Address','tu.education')
        // ->orderBy('course')->get();

        // $t_univ2 =  DB::select('CALL SP_SCHOLARSHIP_COMPUTE_STUDENT(F_SCHOLARSHIP_COMPUTE_STUDENT(@TOTALSTUD_SCHOLARSHIP))');

        // $t_total2 =  DB::select('CALL SP_SCHOLARSHIP_COMPUTE_TOTAL_PER_CAMPUS_EDUC(F_SCHOLARSHIP_COMPUTE_STUDENT(@TOTALSTUD_SCHOLARSHIP))');

        // $t_educ2 =  DB::select('CALL SP_SCHOLARSHIP_COMPUTE_TOTAL_EDUC(F_SCHOLARSHIP_COMPUTE_STUDENT(@TOTALSTUD_SCHOLARSHIP))');
        // END FOR TABLE
        // FOR CHART START
        // $result2 = DB::table('scholarships')->join('t_universities as tu', 'scholarships.tu_id', '=', 'tu.id')
        // ->join('universities as u', 'tu.u_id', '=', 'u.id')
        // ->select( DB::raw('UCASE(u.address) as Address,
        //         SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female) as total'))
        // ->groupBy('Address')
        // ->orderBy('course')
        // ->get()->toArray();
            
        //NAKAKALOKA YUNG SA DIVISOR
        // $result_univ2 = DB::table('scholarships')
        // ->join('t_universities  as tu', 'scholarships.tu_id', '=', 'tu.id')
        // ->join('universities  as u', 'tu.u_id', '=', 'u.id')
        // ->select( DB::raw('UCASE(u.address) as Address1'),'tu.course',
        //           DB::raw('SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)) as Entrance,
        //                     SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female) as Resident,
        //                     SUM(sga_male)+SUM(sga_female) as Special,
        //                     SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female) as Financial,
        //                     SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_male)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female) as total,

        //                      ROUND((SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female))/(
        //                         SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female)),2)*100 as entrancePercent,
        //                      ROUND((SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female))/(
        //                         SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female)),2)*100 as residentPercent,
        //                      ROUND((SUM(sga_male)+SUM(sga_female))/(
        //                         SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female)),2)*100 as specialPercent,
        //                      ROUND((SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female))/(
        //                         SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female)),2)*100 as financialPercent,
        //                      ROUND((SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female))/(
        //                         SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female)),2)*100 as totalPercent'))
        // ->groupBy('Address','tu.course')
        // ->orderBy('Address')->get();



        // $result_major2 = DB::table('scholarships')
        // ->join('t_universities  as tu', 'scholarships.tu_id', '=', 'tu.id')
        // ->join('universities  as u', 'tu.u_id', '=', 'u.id')
        // ->select( DB::raw('UCASE(u.address) as Address'),'tu.course','tu.major',
        //         DB::raw('SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female) as Entrance,
                        
        //                 SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female) as Resident,

        //                 SUM(sga_male)+SUM(sga_female) as Special,

        //                 SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female) as Financial, 
                        
        //                 SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female)+SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female)+SUM(sga_male)+SUM(sga_female)+SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female) as total,

        //                 ROUND((SUM(ent_valid_male)+SUM(ent_valid_female)+SUM(ent_salut_male)+SUM(ent_salut_female)+SUM(ent_firsthon_male)+SUM(ent_firsthon_female)+SUM(ent_achiever_male)+SUM(ent_achiever_female)+SUM(ent_athlete_male)+SUM(ent_athlete_female)+SUM(ent_culturalart_male)+SUM(ent_culturalart_female)+SUM(ent_filmart_male)+SUM(ent_filmart_female)+SUM(ent_hsscpres_male)+SUM(ent_hsscpres_female))/total,2)*100 as entrancePercent,
                        
        //                 ROUND((SUM(resi_preslist_male)+SUM(resi_preslist_female)+SUM(resi_deanlist_male)+SUM(resi_deanlist_female))/total,2)*100 as residentPercent,

        //                 ROUND((SUM(sga_male)+SUM(sga_female))/total,2)*100 as specialPercent,
                        
        //                 ROUND((SUM(fa_culturalgrp_male)+SUM(fa_culturalgrp_female)+SUM(fa_sc_male)+SUM(fa_sc_female))/total,2)*100 as financialPercent'))
        // ->groupBy('Address','tu.major')
        // ->orderBy('Address')
        // ->get();
    //END FOR CHART


        // return view('pages.vp_scholarship',compact('t_univ2','t_loc2','t_total2','result2','result_univ2','result_major2','t_educ2' ),array('user' => Auth ::user()));
    }


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

