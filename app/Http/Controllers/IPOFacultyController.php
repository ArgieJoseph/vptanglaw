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

class IPOFacultyController extends Controller
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
    public function faculty(Request $request)
    {
         
        $branch= DB::table('universities')
            ->pluck('name','id');

          return view('pages.ipo_import_faculty',compact('semester','sy','branch'),array('user'=> Auth::user()));
    }
    public function exportfaculty(Request $r)
{     
             $sem=DB::table('semesters')
        ->where('status',1)
        ->value('id');

           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');
      $u=$r->id;

      $name=DB::table('universities')
          ->where('id',$u)
          ->value('code');

               $acadrank_ft = array('NoofInstructor', 'AssistantProf','AssociateProfessor','Professor');
               $acadrank_pt = array('NoofInstructor', 'Lecturer','Assistantlecturer','AssociateLecturer','ProfessorialLecturer','UniversityProfessorialLecturer');
               $achievement = array('International', 'National');
               $agegroup = array('25-below', '26-31','32-37','38-43','44-49','50-55','56-61','26-27','68-73','74-79','80-above');
               $degree = array('Bachelor', 'Master','PhD');
               $program = array('Classification', 'Benifeciary');
               $research = array('Research');
               $salarygrade = array('12-14','15-18','19-23','24-30');
               $specialization = array('EducScienceTeacherTraining','FineArts','Humanities','SocialBehavScience','BusAdmRelated','LawJurisPrudence','NaturalScience','Mathematics','ItRelated','MedicalAllied','EngineeringTech','ArchiTownPlanning','AgriForestry','ServiceTrades','MasscommDocu','others');
               $status = array('ft_male','ft_female','pt_male','pt_female');
               $workloadunit = array('6-below','7-12','13-18','19-24','25-30','31-36','37-42','43-above');

                $acadrank_ft_data = json_decode( json_encode($acadrank_ft), true);
                $acadrank_pt_data = json_decode( json_encode($acadrank_pt), true);
                $achievement_data = json_decode( json_encode($achievement), true);
                $agegroup_data = json_decode( json_encode($agegroup), true);
                $degree_data = json_decode( json_encode($degree), true);
                $program_data = json_decode( json_encode($program), true);
                $research_data = json_decode( json_encode($research), true);
                $salarygrade_data = json_decode( json_encode($salarygrade), true);
                $specialization_data = json_decode( json_encode($specialization), true);
                $status_data = json_decode( json_encode($status), true);
                $workloadunit_data = json_decode( json_encode($workloadunit), true);



      return Excel::create($name,function($excel) use($acadrank_ft_data,$acadrank_pt_data,$achievement_data,$agegroup_data,$degree_data,$program_data,$research_data,$salarygrade_data,$specialization_data,$status_data,$workloadunit_data){

   
        $excel->sheet('Academic Rank (Full-Time)',function($sheet) use($acadrank_ft_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($acadrank_ft_data);



              });



        $excel->sheet('Academic Rank (Part-Time)',function($sheet) use($acadrank_pt_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($acadrank_pt_data);



              });

                $excel->sheet('Achievement ',function($sheet) use($achievement_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($achievement_data);



              });

        $excel->sheet('Age Group ',function($sheet) use($agegroup_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($agegroup_data);



              });



                        $excel->sheet('Degree',function($sheet) use($degree_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($degree_data);



              });

      $excel->sheet('Programs',function($sheet) use($program_data){

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($program_data);



              });

        $excel->sheet('Researches',function($sheet) use($research_data){
               

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($research_data);



              });


          $excel->sheet('Salary Grades',function($sheet) use($salarygrade_data){
         

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($salarygrade_data);



              });

            $excel->sheet('Specialization',function($sheet) use($specialization_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($specialization_data);



              });

              $excel->sheet('Statuses',function($sheet) use($status_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($status_data);



              });

                $excel->sheet('Workload Units',function($sheet) use($workloadunit_data){
         

      

            $sheet->cells('A1', function($cells) {
              $cells->setBackground('#35ceca'); 

        });
            $sheet->cell('C1', function($cell) {
              $cell->setBackground('#35ceca');

        });
          $sheet->cell('D1', function($cell) {
              $cell->setBackground('#35ceca');

        });

           $sheet->cell('B1', function($cell) {
              $cell->setBackground('#35ceca');

        });

              
                  $sheet->fromArray($workloadunit_data);



              });

                })->export('xlsx');
            }

 public function import(Request $request){

              if($request->hasFile('sample_file')){
               
  $sem=DB::table('semesters')
        ->where('status',1)
        ->value('id');
      $u=$request->id;
           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');
        
            $path = $request->file('sample_file')->getRealPath();
            $acadrank_ft = \Excel::selectSheetsByIndex(0)->load($path)->get();
            //$tp = \Excel::selectSheetsByIndex(1)->load($path)->get();


            if($acadrank_ft->count()){
                foreach ($acadrank_ft as $key  => $value) {
                    $aft[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'instructor' => $value->noofinstructor,
                     'asst_prof' => $value->assistantprof,
                     'asso_prof' => $value->associateprofessor,
                     'professor' => $value->professor
      
                      
                   ];
                FacultyAcadrankFt::where('u_id', $aft[0])->delete();
                }

                if(!empty($aft) ){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('faculty_acadrank_fts')->insert($aft);
            
                
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
