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


        if($r->category == "GenderProgram")
        {

            $higherprog="";
            $technicalprog="";
            $grandtotal="";

            $t_loc =  DB::select('CALL SP_ENROLLMENT_COMPUTE_LOCATION(?,?)',array($r->schoolyear,$r->sem));

            $t_univ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_STUDENT(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD),?,?)',array($r->schoolyear,$r->sem));

            $t_total =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_PER_CAMPUS_EDUC(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD),?,?)',array($r->schoolyear,$r->sem));

            $t_educ =  DB::select('CALL SP_ENROLLMENT_COMPUTE_TOTAL_EDUC(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD),?,?)',array($r->schoolyear,$r->sem));

            $t_grand_total =  DB::select('CALL SP_ENROLLMENT_COMPUTE_GRAND_TOTAL(F_ENROLLMENT_COMPUTE_STUDENT(@TOTALSTUD),?,?)',array($r->schoolyear,$r->sem));


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

            return response()->json(array($higherprog,$technicalprog,$grandtotal));

        }  


               /**
     * Show the report for Year & Program.
     *
     */ 

        if($r->category == "YearProgram"){

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

