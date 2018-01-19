<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;


class IPOScholarshipController extends Controller
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
    public function index(Request $request)
    {
         
        $branch= DB::table('universities')
            ->pluck('name','id');

          return view('pages.ipo_import_scholarship',compact('branch'),array('user'=> Auth::user()));
    }



     public function export(Request $request)
    {
           $sem=DB::table('semesters')
        ->where('status',1)
        ->value('id');

           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');

           $u=$request->id;

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
                ->select('course as Course','major AS Major')
 
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

             $sheet->cell('C1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('ValidictorianMale');

        });
             $sheet->cell('D1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('ValidictorianFemale');

        });
             $sheet->cell('E1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SalutatorianMale');

        });
			$sheet->cell('F1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SalutatorianFemale');

        });
			$sheet->cell('G1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FirstHonorMale');

        });
			$sheet->cell('H1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FirstHonorFemale');

        });
			$sheet->cell('I1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AchieverMale');

        });
			$sheet->cell('J1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AchieverFemale');

        });
			$sheet->cell('K1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AthleteMale');

        });
			$sheet->cell('L1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('AthleteFemale');

        });
			$sheet->cell('M1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalArtistMale');

        });
			$sheet->cell('N1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalArtistFemale');

        });			
			$sheet->cell('O1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('FilmArtistMale');

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
                  $sheet->fromArray($ents);

              });



        $excel->sheet('Resident or Academic Scholars',function($sheet) use($ents){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cell('C1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('PresidentMale');

        });
             $sheet->cell('D1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('PresidentFemale');

        });
             $sheet->cell('E1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('DeanMale');

        });
			$sheet->cell('F1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('DeanFemale');

        });
                                        
                  $sheet->fromArray($ents);

              });


       $excel->sheet('Special Grant Scholars',function($sheet) use($ents){

             $sheet->cell('C1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SpecialGrantMale');

        });
             $sheet->cell('D1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('SpecialGrantFemale');

        });
                                        
                  $sheet->fromArray($ents);

              });



           $excel->sheet('Financial Grant Scholars',function($sheet) use($ents){

                       $sheet->cell('C1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalGroupMale');

        });
             $sheet->cell('D1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('CulturalGroupFemale');

        });
             $sheet->cell('E1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('StudentCouncilMale');

        });
			$sheet->cell('F1', function($cell) {
              $cell->setBackground('#64c764');
               $cell->setValue('StudentCouncilFemale');

        });
                                        
                  $sheet->fromArray($ents);

              });

              })->export('xlsx');
            }
   

     

	public function import(Request $request){

              if($request->hasFile('sample_file')){
               

        
            $path = $request->file('sample_file')->getRealPath();
            $tp = \Excel::selectSheetsByIndex(0)->load($path)->get();
            $tp1 = \Excel::selectSheetsByIndex(1)->load($path)->get();
            $tp2 = \Excel::selectSheetsByIndex(2)->load($path)->get();
            $tp3 = \Excel::selectSheetsByIndex(3)->load($path)->get();


            if($tp->count()){
                foreach ($tp as $key  => $value) {
                    $arrtp[] = [ 
                      'tu_id' => $value->uid,
                     '1stmale' => $value->stmale,
                     '1stfemale' => $value->stfemale,
                     '2ndmale' => $value->ndmale,
                     '2ndfemale' => $value->ndfemale,
                     '3rdmale' => $value->rdmale,
                     '3rdfemale' => $value->rdfemale,
                     '4thmale' => $value->rthmale,
                     '4thfemale' => $value->rthfemale,
                     '5thmale' => $value->fthmale,
                     '5thfemale' => $value->fthfemale,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                'updated_at' => \Carbon\Carbon::now()
                      
                   ];
                        DB::table('graduates')->where('tu_id',$value->id)
                                            ->where('year',$y)
                                            ->where('mid_end',$my)
                                            ->delete();
                }

                if(!empty($arrhe) || !empty($arrtp) ){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('t_enrollments')->insert($arrhe);
                    \DB::table('t_enrollments')->insert($arrtp);
                
                    dd('Insert Record successfully.');
                }
                else
                {
                  dd('You dont fill all.');
                }
            }

        }
        dd('Request data does not have any files to import.');      
    } 



}
