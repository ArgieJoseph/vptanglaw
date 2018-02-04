<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;
use App\Graduate;
use App\University;
use App\Scholarship;

class RegistrarScholarshipController extends Controller
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
    public function index(Request $request)
    {
          $offered = DB::table('report_weights')->where('name','Scholarship')->get();
          return view('pages.rg_scholarship',compact('offered'),array('user'=> Auth::user()));
    }



     public function export(Request $request)
    {
           $sem=DB::table('semesters')
        ->where('status',1)
        ->value('id');

           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');
       $id = Auth::id();


          $u = DB::table('role_admins')
          ->where('role_id',2)
          ->where('admin_id',$id)
          ->value('u_id');

      $tu = DB::table('t_universities')
      ->join('semesters','t_universities.sem_id','=','semesters.id')
      ->join('school_years','t_universities.sy_id','=','school_years.id')
      ->join('universities','t_universities.u_id','=','universities.id')
      ->where('t_universities.sem_id',$sem)
      ->where('t_universities.sy_id',$sys)
      ->where('t_universities.u_id',$u)
      ->value('t_universities.id');


          $name=DB::table('universities')
          ->where('id',$u)
          ->value('code');
 


                       $ent = DB::table('t_universities')
   
                ->join('universities','t_universities.u_id','=','universities.id')
                ->select('t_universities.id AS ID','course as Course','major AS Major')
 
                ->where('t_universities.u_id',$u)
                ->where('t_universities.sem_id',$sem)
                ->where('t_universities.sy_id',$sys)
                ->get();




                $ents = json_decode( json_encode($ent), true);

      return Excel::create($name,function($excel) use($ents){
        //$excel->setTitle('Higher Education');
          //put here the editor $excel->setCreator('Argie Joseph D. Bigornia')

        //Higher Education
   
        $excel->sheet('Entrance Scholars',function($sheet) use($ents){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cell('D1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('ValidictorianMale');

        });
             $sheet->cell('E1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('ValidictorianFemale');

        });
             $sheet->cell('F1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SalutatorianMale');

        });
      $sheet->cell('G1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SalutatorianFemale');

        });
      $sheet->cell('H1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FirstHonorMale');

        });
      $sheet->cell('I1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FirstHonorFemale');

        });
      $sheet->cell('J1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AchieverMale');

        });
      $sheet->cell('K1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AchieverFemale');

        });
      $sheet->cell('L1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AthleteMale');

        });
      $sheet->cell('M1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AthleteFemale');

        });
      $sheet->cell('N1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalArtistMale');

        });
      $sheet->cell('O1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalArtistFemale');

        });     
      $sheet->cell('P1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FilmArtistMale');

        });
      $sheet->cell('Q1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FilmArtistFemale');

        });
      $sheet->cell('R1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('HSCouncilMale');

        });      
      $sheet->cell('S1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('HSCouncilFemale');

        });   
                   $sheet->cell('T1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('PresidentMale');

        });
             $sheet->cell('U1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('PresidentFemale');

        });
             $sheet->cell('V1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('DeanMale');

        });
      $sheet->cell('W1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('DeanFemale');

        });

                   $sheet->cell('X1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SpecialGrantMale');

        });
             $sheet->cell('Y1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SpecialGrantFemale');

        });

                         $sheet->cell('Z1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalGroupMale');

        });
             $sheet->cell('AA1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalGroupFemale');

        });
             $sheet->cell('AB1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('StudentCouncilMale');

        });
      $sheet->cell('AC1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('StudentCouncilFemale');

        });
                         
                  $sheet->fromArray($ents);

              });


              })->export('xlsx');
            }
   

     

  public function import(Request $request){

              if($request->hasFile('sample_file')){
               
         $y=$request->year;
          $my=$request->tyear;
          $sem=DB::table('semesters')
        ->where('status',1)
        ->value('id');

           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');

           $u=$request->id;
               $id = Auth::id();


          $u = DB::table('role_admins')
          ->where('role_id',2)
          ->where('admin_id',$id)
          ->value('u_id');
            $path = $request->file('sample_file')->getRealPath();
            $tp = \Excel::selectSheetsByIndex(0)->load($path)->get();
//I do this because of some bugs of laravel excel better check for good and nice solution than this XD.
$argie='validictorianmale';
$brgie='validictorianfemale';
$crgie='salutatorianmale';
$drgie='salutatorianfemale';
$ergie='firsthonormale';
$frgie='firsthonorfemale';
$grgie='achievermale';
$hrgie='achieverfemale';
$irgie='athletemale';
$jrgie='athletefemale';
$krgie='culturalartistmale';
$lrgie='culturalartistfemale';
$mrgie='filmartistmale';
$nrgie='filmartistfemale';
$orgie='hscouncilmale';
$prgie='hscouncilfemale';
$qrgie='culturalgroupmale';
$rrgie='culturalgroupfemale';
$srgie='studentcouncilmale';
$trgie='studentcouncilfemale';
$urgie='presidentmale';
$vrgie='presidentfemale';
$wrgie='deanmale';
$xrgie='deanfemale';
$yrgie='specialgrantmale';
$zrgie='specialgrantfemale';



            if($tp->count() || $tp1->count() || $tp2->count() || $tp3->count()){
                foreach ($tp as $key  => $value) {
                    $arrtp[] = [ 
                      'tu_id' => $value->id,
                     'ent_valid_male' => $value->$argie,
                     'ent_valid_female' => $value->$brgie,
                     'ent_salut_male' => $value->$crgie,
                     'ent_salut_female' => $value->$drgie,
                     'ent_firsthon_male' => $value->$ergie,
                     'ent_firsthon_female' => $value->$frgie,
                     'ent_achiever_male' => $value->$grgie,
                     'ent_achiever_female' => $value->$hrgie,
                     'ent_athlete_male' => $value->$irgie,
                     'ent_athlete_female' => $value->$jrgie,
                     'ent_culturalart_male' => $value->$krgie,
                     'ent_culturalart_female' => $value->$lrgie,
                     'ent_filmart_male' => $value->$mrgie,
                     'ent_filmart_female' => $value->$nrgie,
                     'ent_hsscpres_male' => $value->$orgie,
                     'ent_hsscpres_female' => $value->$prgie,
                      'fa_culturalgrp_male' => $value->$qrgie,
                     'fa_culturalgrp_female' => $value->$rrgie,
                     'fa_sc_male' => $value->$srgie,
                     'fa_sc_female' => $value->$trgie,
                     'resi_preslist_male' => $value->$urgie,
                     'resi_preslist_female' => $value->$vrgie,
                     'resi_deanlist_male' => $value->$wrgie,
                     'resi_deanlist_female' => $value->$xrgie,
                     'sga_male' => $value->$yrgie,
                     'sga_female' => $value->$zrgie,

                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                'updated_at' => \Carbon\Carbon::now()


                      
                   ];

                
                   
                      DB::table('scholarships')->where('tu_id',$value->id)
                                            ->delete();   

                }

                                
              }

                if(!empty($arrtp) ){
                 // \DB::table('t_enrollments')->detele();
            
                    \DB::table('scholarships')->insert($arrtp);
                

                              $cdate = \Carbon\Carbon::today();
//getting id of report to provide values
          $rep = DB::table('report_weights')->where('name','Graduate')->pluck('id');
//duedate parse to carbon
          $ddd=\Carbon\Carbon::parse($request->duedate);
          //return deduction
              $ded= DB::table('report_weights')->where('id',$rep)->value('deduction');
          //return value of report/perfect points
              $value= DB::table('report_weights')->where('id',$rep)->value('value');
//diff function
              $aa=$ddd->diffInDays($cdate);
//return no of days per deduction
              $day=DB::table('report_weights')->where('id',$rep)->value('dayofdeduction');
//round
              $count=round($aa/$day);
//return value to be deduct
              $tded = $count*$ded;
              //timeliness
              $tvalue = $value-$tded;

              //DB::table('users')->whereId(Auth::user()->id)->increment('position');
                                          
               $nid= DB::table('t_universities')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)->value('id');

              $adminid= DB::table('scholarships')->where('tu_id',$nid)
                                                  ->value('id');

              //completeness(increment[will depend on how many times they will import or change the data they submitted])
            // DB::table('admin_empstatuses')->whereId($adminid)->increment('c_point');
              $unive=University::find($u);
              $unive['c_point']= $unive['c_point']+1;
             
              $unive->save();
  
              $univ=Scholarship::find($adminid);
              $univ['t_point'] = $tvalue;
              $univ->save();

                    dd('Insert Record successfully.');
                }
                else
                {
                  dd('You dont fill all.');
                }
            
        }
        dd('Request data does not have any files to import.');      
    } 




}
