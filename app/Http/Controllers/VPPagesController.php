<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolYear;
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
        $school_years = DB::table('school_years')->get()->toArray();

        $sem = DB::table('semesters')->get()->toArray();

        return view('pages.vp_enrollment',compact('school_years','sem'),array('user' => Auth ::user()));
    }

public function search(Request $r)
{
    if($r->ajax())
    {
                      /**
     * Show the report for Gender & Program.
     *
     */ 

        if($r->category == "GenderProgram")
        {

            $higherprog="";
            $technicalprog="";
            $grandtotal="";
            $schoolsem="";


            $t_loc =  DB::select('CALL SP_ENROLLMENT_COMPUTE_LOCATION');

            $t_univ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_STUDENT(?,?,F_EN_TOTAL'.'('.$r->schoolyear.','.$r->sem.')'.')',array($r->schoolyear,$r->sem));

            $t_total =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_PER_CAMPUS_EDUC(?,?,F_EN_TOTAL'.'('.$r->schoolyear.','.$r->sem.')'.')',array($r->schoolyear,$r->sem));

            $t_educ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_EDUC(?,?,F_EN_TOTAL'.'('.$r->schoolyear.','.$r->sem.')'.')',array($r->schoolyear,$r->sem));

            $t_grand_total =  DB::select('CALL SP_ENROLLMENT_COMPUTE_GRAND_TOTAL(?,?,F_EN_TOTAL'.'('.$r->schoolyear.','.$r->sem.')'.')',array($r->schoolyear,$r->sem));

            $schoolyear = DB::table('school_years')
            ->select('start_date','end_date')
            ->where('id', $r->schoolyear)
            ->get();

            $semester = DB::table('semesters')
            ->select('name')
            ->where('id', $r->sem)
            ->get();



            foreach($semester as $key =>$sem)
            {   
                foreach($schoolyear as $key =>$scy)
                {   
                    $schoolsem.= $sem->name.',  S.Y. '.$scy->start_date.'-'.$scy->end_date.'</center>'.'</h4>'.'</b>'.$schoolsem.='<b>'.'<h4>'.'<center>';
                    
                }
                
            }

            foreach($t_loc as $key =>$tl)
            {
                    
                        if ($tl->education == "Higher Education")
                        {
                            $higherprog.= 
                            '<tr>'.
                            '<th colspan="7" style="width: 40%; border:1px solid black; padding-left:2.5%; font-weight: bold; color:black;">'.
                                    $tl->Address.
                                '</th>'.
                            '</tr>';

                                foreach($t_univ as $key =>$sp)
                                {
                                    if ($sp->Address == $tl->Address && $sp->education == "Higher Education" )
                                    {

                                        $higherprog .= '<tr>'.
                                            '<td  style="width: 40%; border:1px solid black; padding-left:5%;color:black;">'.$sp->course ."-". $sp->major.'</td>'.   
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'. $sp->Male.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'. $sp->malepercent.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'. $sp->Female.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'.$sp->femalepercent.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'.$sp->total.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'.$sp->totalpercent.'</td>'.              
                                        '</tr>';
                                    }
                                    
                                }

                                foreach($t_total as $key =>$tt)
                                {
                                    if ($tl->Address == $tt->Address && $tt->education == "Higher Education")
                                    {

                                        $higherprog .= '<tr>'.
                                            '<td  style="width: 40%; border:1px solid black; padding-left:42%; color:black;  font-weight: bold; background-color:#bfbfbf;">'.
                                                'Total'.
                                            '</td>'.
                                            '<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">'.
                                                 $tt->Male.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'
                                                .$tt->malepercent.
                                            '</td>'.  
                                            '<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">'.
                                                $tt->Female.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'.
                                                $tt->femalepercent.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'.
                                                $tt->total.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'.
                                                $tt->totalpercent.
                                            '</td>'.            
                                        '</tr>';
                                    }
                                }
                        }


            }
        
            foreach($t_educ as $key =>$te)
            {   
                if ($te->education == "Higher Education" )                        
             {
                    $higherprog.='<tr>'.
                    
                    '<td style="width: 40%; border:1px solid black; padding-left:13%;  font-weight: bold; color:black; background-color:#ffff00; ">'.
                                    'Sub Total, Higher Education'.
                    '</td>'.   
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->Male.
                                '</td>'.
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->malepercent.
                                '</td>'. 
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->Female.'</td>'.  
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                    $te->femalepercent.
                                '</td>'.  
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->total.
                                '</td>' .
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->totalpercent. 
                                '</td>'.             
                            '</tr>';
             }
            }

            foreach($t_loc as $key =>$tl)
            {
                if ($tl->education == "Technical Program")
                {
                            $technicalprog.= 
                            '<tr>'.
                            '<th colspan="7" style="width: 40%; border:1px solid black; padding-left:2.5%; font-weight: bold; color:black;">'.
                                    $tl->Address.
                                '</th>'.
                            '</tr>';

                                foreach($t_univ as $key =>$sp)
                                {
                                    if ($sp->Address == $tl->Address && $sp->education == "Technical Program" )
                                    {

                                        $technicalprog .= '<tr>'.
                                            '<td  style="width: 40%; border:1px solid black; padding-left:5%;color:black;">'.$sp->course ."-". $sp->major.'</td>'.   
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'. $sp->Male.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'. $sp->malepercent.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'. $sp->Female.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'.$sp->femalepercent.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'.$sp->total.'</td>'.  
                                            '<td  style="width: 40%; border:1px solid black;color:black;">'.$sp->totalpercent.'</td>'.              
                                        '</tr>';
                                    }
                                    
                                }

                                foreach($t_total as $key =>$tt)
                                {
                                    if ($tl->Address == $tt->Address && $tt->education == "Technical Program")
                                    {

                                        $technicalprog .= '<tr>'.
                                            '<td  style="width: 40%; border:1px solid black; padding-left:42%; color:black;  font-weight: bold; background-color:#bfbfbf;">'.
                                                'Total'.
                                            '</td>'.
                                            '<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">'.
                                                 $tt->Male.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'
                                                .$tt->malepercent.
                                            '</td>'.  
                                            '<td  style="width: 40%; border:1px solid black; color:black;  background-color:#bfbfbf;">'.
                                                $tt->Female.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'.
                                                $tt->femalepercent.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'.
                                                $tt->total.
                                            '</td>'.   
                                            '<td  style="width: 40%; border:1px solid black; color:black; background-color:#bfbfbf; ">'.
                                                $tt->totalpercent.
                                            '</td>'.            
                                        '</tr>';
                                    }
                                }
                }
            }
        
            foreach($t_educ as $key =>$te)
            {   
                if ($te->education == "Technical Program" )                        
             {
                    $technicalprog.='<tr>'.
                    
                    '<td style="width: 40%; border:1px solid black; padding-left:13%;  font-weight: bold; color:black; background-color:#ffff00; ">'.
                                    'Sub Total, Technical Program'.
                    '</td>'.   
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->Male.
                                '</td>'.
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->malepercent.
                                '</td>'. 
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->Female.'</td>'.  
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                    $te->femalepercent.
                                '</td>'.  
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->total.
                                '</td>' .
                                '<td  style="width: 40%; border:1px solid black;color:black; background-color:#ffff00;">'.
                                     $te->totalpercent.
                                '</td>'.             
                            '</tr>';
             }
            }

            foreach($t_grand_total as $key =>$tgt)
            {

                $grandtotal.=   '<tr>'.
                            '<td style="width: 40%; border:1px solid black; padding-left:18%;  font-weight: bold; color:black; background-color:#00b0f0;">'.'GRAND TOTAL'.'</td>'.  
                            '<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">'.$tgt->Male.'</td>'.  
                            '<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">'.$tgt->malepercent.'</td>'.  
                            '<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">'.$tgt->Female.'</td>'.  
                            '<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">'.$tgt->femalepercent.'</td>'.  
                            '<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">'.$tgt->total.'</td>'.  
                            '<td  style="width: 40%; border:1px solid black;color:black; background-color:#00b0f0;">'.$tgt->totalpercent.'</td>'.                        
                        '</tr>';
            }

            return response()->json(array($higherprog,$technicalprog,$grandtotal,$schoolsem));

        }  


        /**
     * Show the report for Year & Program.
     *
     */ 

        if($r->category == "YearProgram")
        {

        }   

        if($r->category == "GenderProgramChart")
        {

    $result = DB::table('t_enrollments')->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->join('semesters  as sem', 'tu.sem_id', '=', 'sem.id')
    ->join('school_years  as sy', 'tu.sy_id', '=', 'sy.id')
    ->select( DB::raw('UCASE(u.address) as Address, SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as total'))
    ->groupBy('Address')
    ->orderBy('course')
    ->where('tu.sy_id', $r->schoolyear)
    ->where('tu.sem_id', $r->sem)
    ->get()->toArray();
        


    $result_univ = DB::table('t_enrollments')
    ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->join('semesters  as sem', 'tu.sem_id', '=', 'sem.id')
    ->join('school_years  as sy', 'tu.sy_id', '=', 'sy.id')
    ->select( DB::raw('UCASE(u.address) as Address1'),'tu.course',
              DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale) as Male,
                         SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as Female,
                         SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as total,

                         ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as malepercent,
                         ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as femalepercent'))
    ->groupBy('Address','tu.course')
    ->orderBy('Address')
    ->where('tu.sy_id', $r->schoolyear)
    ->where('tu.sem_id', $r->sem)
    ->get();



    $result_major = DB::table('t_enrollments')
    ->join('t_universities  as tu', 't_enrollments.tu_id', '=', 'tu.id')
    ->join('universities  as u', 'tu.u_id', '=', 'u.id')
    ->join('semesters  as sem', 'tu.sem_id', '=', 'sem.id')
    ->join('school_years  as sy', 'tu.sy_id', '=', 'sy.id')
    ->select( DB::raw('UCASE(u.address) as Address'),'tu.course','tu.major',
            DB::raw('SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale) as Male,
                    
                    SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as Female, 
                    
                    SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale) as total,

                    ROUND((SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as malepercent,
                    
                    ROUND((SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale))/(SUM(1stmale)+SUM(2ndmale)+SUM(3rdmale)+SUM(4thmale)+SUM(5thmale)+SUM(1stfemale)+SUM(2ndfemale)+SUM(3rdfemale)+SUM(4thfemale)+SUM(5thfemale)),2)*100 as femalepercent'))
    ->groupBy('Address','tu.major')
    ->orderBy('Address')
    ->where('tu.sy_id', $r->schoolyear)
    ->where('tu.sem_id', $r->sem)
    ->get();

     return response()->json(array($result,$result_univ,$result_major));

        }       


    }
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

