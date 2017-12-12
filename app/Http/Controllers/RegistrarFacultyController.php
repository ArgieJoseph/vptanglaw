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

class RegistrarFacultyController extends Controller
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

          return view('pages.rg_faculty',array('user'=> Auth::user()));
    }

      public function export(Request $r)
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

      $name=DB::table('universities')
          ->where('id',$u)
          ->value('code');

               $acadrank_ft = array('NoofInstructor', 'AssistantProf','AssociateProfessor','Professor');
               $acadrank_pt = array('NoofInstructor', 'Lecturer','Assistantlecturer','AssociateLecturer','ProfessorialLecturer','UniversityProfessorialLecturer');
               $achievement = array('International', 'National');
               $agegroup = array('25below', '26to31','32to37','38to43','44to49','50to55','56to61','62to67','68to73','74to79','80above');
               $degree = array('Bachelor', 'Master','PhD');
               $program = array('Classification', 'Benefeciary');
               $research = array('Research');
               $salarygrade = array('12to14','15to18','19to23','24to30');
               $specialization = array('EducScienceTeacherTraining','FineArts','Humanities','SocialBehavScience','BusAdmRelated','LawJurisPrudence','NaturalScience','Mathematics','ItRelated','MedicalAllied','EngineeringTech','ArchiTownPlanning','AgriForestry','ServiceTrades','MasscommDocu','others');
               $status = array('FullTimeMale','FullTimeFemale','PartTimeMale','PartTimeFemale');
               $workloadunit = array('6below','7to12','13to18','19to24','25to30','31to36','37to42','43above');

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

       $id = Auth::id();
		$u = DB::table('role_admins')
			 		->where('role_id',2)
			 		->where('admin_id',$id)
			 		->value('u_id');

           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');
        
            $path = $request->file('sample_file')->getRealPath();
            $acadrank_ft = \Excel::selectSheetsByIndex(0)->load($path)->get();
            $acadrank_pt = \Excel::selectSheetsByIndex(1)->load($path)->get();
            $achievement = \Excel::selectSheetsByIndex(2)->load($path)->get();
            $agegroup = \Excel::selectSheetsByIndex(3)->load($path)->get();
            $degree = \Excel::selectSheetsByIndex(4)->load($path)->get();
            $programs = \Excel::selectSheetsByIndex(5)->load($path)->get();
            $researches = \Excel::selectSheetsByIndex(6)->load($path)->get();
            $salarygrade = \Excel::selectSheetsByIndex(7)->load($path)->get();
            $specialization = \Excel::selectSheetsByIndex(8)->load($path)->get();
            $statuses = \Excel::selectSheetsByIndex(9)->load($path)->get();
            $workloadunit = \Excel::selectSheetsByIndex(10)->load($path)->get();



            //$tp = \Excel::selectSheetsByIndex(1)->load($path)->get();


            if($acadrank_ft->count() && 
                $acadrank_pt->count() && 
                $achievement->count() &&
                $agegroup->count() && 
                $degree->count() && 
                $programs->count() && 
                $researches->count() && 
                $salarygrade->count() && 
                $specialization->count() && 
                $statuses->count() && 
                $workloadunit->count()){

$below = "6below";
$a ="7to12";
$b ="13to18";
$c ="19to24";
$d ="25to30";
$e ="31to36";
$f ="37to42";
$g ="43above";

              foreach ($workloadunit as $key  => $value) {
                    $wrkldnts[] = [
          
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     '6-below' => $value->$below,
                     '7-12' => $value->$a,
                     '13-18' => $value->$b,
                     '19-24' => $value->$c,
                     '25-30' => $value->$d,
                     '31-36' => $value->$e,
                     '37-42' => $value->$f,
                     '43-above' => $value->$g


                   ];
               
                DB::table('faculty_workloadunits')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

              foreach ($statuses as $key  => $value) {
                    $sttss[] = [
          
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'ft_male' => $value->fulltimemale,
                     'ft_female' => $value->fulltimefemale,
                     'pt_male' => $value->parttimemale,
                     'pt_female' => $value->parttimefemale


                   ];
               
                DB::table('faculty_statuses')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

              foreach ($specialization as $key  => $value) {
                    $spclztn[] = [
          
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'educ_science_teacher_training' => $value->educscienceteachertraining,
                     'fine_arts' => $value->finearts,
                     'humanities' => $value->humanities,
                     'socialbehav_science' => $value->socialbehavscience,
                     'busadm_related' => $value->busadmrelated,
                     'law_jurisprudence' => $value->lawjurisprudence,
                     'natural_science' => $value->naturalscience,
                     'it_related' => $value->itrelated,
                     'medical_allied' => $value->medicalallied,
                     'engineering_tech' => $value->engineeringtech,
                     'archi_townplanning' => $value->architownplanning,
                     'agri_forestry' => $value->agriforestry,
                     'service_trades' => $value->servicetrades,
                     'masscomm_docu' => $value->masscommdocu,
                     'others' => $value->others


                   ];
               
                DB::table('faculty_specializations')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

$aa="12to14";
$bb="15to18";
$cc="19to23";
$dd="24to30";

              foreach ($salarygrade as $key  => $value) {
                    $slrygrd[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     '12-14' => $value->$aa,
                     '15-18' => $value->$bb,
                     '19-23' => $value->$cc,
                     '24-30' => $value->$dd

                   ];
               
                DB::table('faculty_salarygrades')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

              foreach ($researches as $key  => $value) {
                    $rsrchs[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'research' => $value->research

                   ];
               
                DB::table('faculty_researches')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


              foreach ($programs as $key  => $value) {
                    $prgrms[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'classification' => $value->classification,
                     'beneficiary' => $value->benefeciary
                       
                   ];
               
                DB::table('faculty_programs')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


              foreach ($degree as $key  => $value) {
                    $dgr[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'bachelor' => $value->bachelor,
                     'master' => $value->master,
                     'phd' => $value->phd
                       
                   ];
               
                DB::table('faculty_degrees')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

$h="25below";
$i="26to31";
$j="32to37";
$k="38to43";
$l="44to49";
$m="50to55";
$n="56to61";
$o="62to67";
$p="68to73";
$q="74to79";
$r="80above";


              foreach ($agegroup as $key  => $value) {
                    $aggrp[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     '25-below' => $value->$h,
                     '26-31' => $value->$i,
                     '32-37' => $value->$j,
                     '38-43' => $value->$k,
                     '44-49' => $value->$l,
                     '50-55' => $value->$m,
                     '56-61' => $value->$n,
                     '62-67' => $value->$o,
                     '68-73' => $value->$p,
                     '74-79' => $value->$q,
                     '80-above' => $value->$r
                       
                   ];
               
                DB::table('faculty_agegroups')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

                foreach ($achievement as $key  => $value) {
                    $achvmnt[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'international' => $value->international,
                     'national' => $value->national
                       
                   ];
               
                DB::table('faculty_achievements')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


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
               
                DB::table('faculty_acadrank_fts')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

                  foreach ($acadrank_pt as $key  => $value) {
                    $apt[] = [
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'lecturer' => $value->lecturer,
                     'instructor' => $value->noofinstructor,
                     'asst_lectr' => $value->assistantlecturer,
                     'asso_lectr' => $value->associatelecturer,
                     'prof_lectr' => $value->professoriallecturer,
                     'univprov_lectr' => $value->universityprofessoriallecturer

                      
                   ];
                   DB::table('faculty_acadrank_pts')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

                if(!empty($aft) || !empty($apt) || 
                    !empty($achvmnt) || !empty($aggrp) || 
                    !empty($dgr) || !empty($prgrms) || 
                    !empty($rsrchs) || !empty($slrygrd) || 
                    !empty($spclztn) || !empty($sttss) || 
                    !empty($wrkldnts)){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('faculty_acadrank_fts')->insert($aft);
                    \DB::table('faculty_acadrank_pts')->insert($apt);
                    \DB::table('faculty_achievements')->insert($achvmnt);
                    \DB::table('faculty_agegroups')->insert($aggrp);
                    \DB::table('faculty_degrees')->insert($dgr);
                    \DB::table('faculty_programs')->insert($prgrms);
                    \DB::table('faculty_researches')->insert($rsrchs);
                    \DB::table('faculty_salarygrades')->insert($slrygrd);
                    \DB::table('faculty_specializations')->insert($spclztn);
                    \DB::table('faculty_statuses')->insert($sttss);
                    \DB::table('faculty_workloadunits')->insert($wrkldnts);




            
                
                    dd('Insert Record successfully.');
                }
                else
                {
                  dd('You dont fill all.');
                }
            }

              else
                {
                  dd('You dont fill all.');
                }

        }
        dd('Request data does not have any files to import.');      
    } 
}
