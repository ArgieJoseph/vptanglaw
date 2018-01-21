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
use App\ReportWeight;


class IPOAdminController extends Controller
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
    public function admin(Request $request)
    {
         
        $branch= DB::table('universities')
            ->pluck('name','id');
              $offered = DB::table('report_weights')->where('name','Administrative')->get();

              

          return view('pages.ipo_import_admin',compact('semester','sy','branch','offered'),array('user'=> Auth::user()));
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
            
            $agegroup = \Excel::selectSheetsByIndex(9)->load($path)->get();
            $civilstatus = \Excel::selectSheetsByIndex(8)->load($path)->get();
            $attainment = \Excel::selectSheetsByIndex(7)->load($path)->get();
            $eligibilitynames = \Excel::selectSheetsByIndex(6)->load($path)->get();
            $eligibilitynos = \Excel::selectSheetsByIndex(5)->load($path)->get();
            $empstatus = \Excel::selectSheetsByIndex(4)->load($path)->get();
            $lastpromotion = \Excel::selectSheetsByIndex(3)->load($path)->get();
            $salarygrade = \Excel::selectSheetsByIndex(2)->load($path)->get();
            $servicegroup = \Excel::selectSheetsByIndex(1)->load($path)->get();
            $serviceyear = \Excel::selectSheetsByIndex(0)->load($path)->get();




            if(
                $agegroup->count() ||
                $civilstatus->count() ||
                $attainment->count() ||
                $eligibilitynames->count() ||
                $eligibilitynos->count() ||
                $empstatus->count() ||
                $lastpromotion->count() ||
                $salarygrade->count() ||
                $servicegroup->count() ||
                $serviceyear->count() 
              ){

$bsy="below1";
$csy="1to5";
$dsy="6to10";
$esy="11to15";
$fsy="16to20";
$gsy="21to25";
$hsy="26to30";
$isy="31to35";
$jsy="36above";


                foreach ($serviceyear as $key  => $value) {
                    $sy[] = [
          
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'below1' => $value->$bsy,
                     '1-5' => $value->$csy,
                     '6-10' => $value->$dsy,
                     '11-15' => $value->$esy,
                     '16-20' => $value->$fsy,
                     '21-25' => $value->$gsy,
                     '26-30' => $value->$hsy,
                     '31-35' => $value->$isy,
                     '36-above' => $value->$jsy,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()

                     
                      
                   ];
                             DB::table('admin_serviceyrs')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }



$as="generaladmin";
$bs="planning";
$cs="medicalhealth";
$ds="educationalarchival";
$es="defensesecurity";
$fs="others";


                foreach ($servicegroup as $key  => $value) {
                    $sg[] = [
          
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'gen_admin' => $value->$as,
                     'planning' => $value->$bs,
                     'med_health' => $value->$cs,
                     'educ_archival' => $value->$ds,
                     'defense_security' => $value->$es,
                     'others' => $value->$fs,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()

                     
                      
                   ];
                             DB::table('admin_servicegrps')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }



$asg="1to5";
$bsg="6to10";
$csg="11to15";
$dsg="16to20";
$esg="21to25";
$fsg="26to30";


                foreach ($salarygrade as $key  => $value) {
                    $sal[] = [
          
                     'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     '1-5' => $value->$asg,
                     '6-10' => $value->$bsg,
                     '11-15' => $value->$csg,
                     '16-20' => $value->$dsg,
                     '21-25' => $value->$esg,
                     '26-30' => $value->$fsg,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()

                     
                      
                   ];
                             DB::table('admin_salarygrades')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }




$al="none";
$bl="below1";
$cl="1to5";
$dl="6to10";
$el="11to15";
$fl="16to20";
$gl="21above";


                foreach ($lastpromotion as $key  => $value) {
                    $last[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'none' => $value->$al,
                     'below1' => $value->$bl,
                     '1-5' => $value->$cl,
                     '6-10' => $value->$dl,
                     '11-15' => $value->$el,
                     '16-20' => $value->$fl,
                     '21-above' => $value->$gl,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()
                     
                      
                   ];
                             DB::table('admin_lastpromotionyrs')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }





$aemp="casualmale";
$bemp="casualfemale";
$cemp="permanentmale";
$demp="permanentfemale";
$eemp="parttimemale";
$femp="parttimefemale";


                foreach ($empstatus as $key  => $value) {
                    $emp[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'casual_male' => $value->$aemp,
                     'casual_female' => $value->$bemp,
                     'permanent_male' => $value->$cemp,
                     'permanent_female' => $value->$demp,
                     'pt_male' => $value->$eemp,
                     'pt_female' => $value->$femp,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()
                     
                      
                   ];
                             DB::table('admin_empstatuses')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


$aelo="with";
$belo="without";



                foreach ($eligibilitynos as $key  => $value) {
                    $elino[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'with' => $value->$aelo,
                     'without' => $value->$belo,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()

                     

      
                      
                   ];
                             DB::table('admin_eligibilitynos')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


$aena="csprofessional";
$bena="cssubprofessional";
$cena="testimonial";
$dena="tesda";
$eena="others";


                foreach ($eligibilitynames as $key  => $value) {
                    $elina[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'cs_pro' => $value->$aena,
                     'cs_subpro' => $value->$bena,
                     'testimonial' => $value->$cena,
                     'tesda' => $value->$dena,
                     'others' => $value->$eena,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()
                     

      
                      
                   ];
                             DB::table('admin_eligibilitynames')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


$attt="elementarylevel";
$bttt="elementarygraduate";
$cttt="highschoollevel";
$dttt="highschoolgraduate";
$ettt="vocational";
$fttt="collegelevel";
$gttt="collegegraduate";
$httt="master";
$ittt="phd";


                foreach ($attainment as $key  => $value) {
                    $att[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'elem_level' => $value->$attt,
                     'elem_grad' => $value->$bttt,
                     'hs_level' => $value->$cttt,
                     'hs_grad' => $value->$dttt,
                     'vocational' => $value->$ettt,
                     'college_level' => $value->$fttt,
                     'college_grad' => $value->$gttt,
                     'masters' => $value->$httt,
                     'phd' => $value->$ittt,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()

      
                      
                   ];
                             DB::table('admin_educattainments')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }



$acv="single";
$bcv="married";
$ccv="widowed";
$dcv="separated";
$ecv="annulled";



                foreach ($civilstatus as $key  => $value) {
                    $ccc[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     'single' => $value->$acv,
                     'married' => $value->$bcv,
                     'widowed' => $value->$ccv,
                     'separated' => $value->$dcv,
                     'annulled' => $value->$ecv,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()
   
                      
                   ];
           DB::table('admin_civilstatuses')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }


$aqwe="25below";
$bqwe="26to30";
$cqwe="31to35";
$dqwe="36to40";
$eqwe="41to45";
$fqwe="46to50";
$gqwe="51to55";
$hqwe="56to60";
$iqwe="61above";


                foreach ($agegroup as $key  => $value) {
                    $aaa[] = [
          
                      'u_id' => $u,
                     'sem_id' => $sem,
                     'sy_id' => $sys,
                     '25-below' => $value->$aqwe,
                     '26-30' => $value->$bqwe,
                     '31-35' => $value->$cqwe,
                     '36-40' => $value->$dqwe,
                     '41-45' => $value->$eqwe,
                     '46-50' => $value->$fqwe,
                     '51-55' => $value->$gqwe,
                     '56-60' => $value->$hqwe,
                     '61-above' => $value->$iqwe,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
                    'updated_at' => \Carbon\Carbon::now()

      
                      
                   ];
                             DB::table('admin_agegroups')->where('u_id',$u)
                                            ->where('sem_id',$sem)
                                            ->where('sy_id',$sys)
                                            ->delete();
                }

                if(
                  !empty($aaa) ||
                   !empty($ccc) || 
                   !empty($att) || 
                   !empty($elina) || 
                   !empty($elino) || 
                   !empty($emp) || 
                   !empty($emp) || 
                   !empty($last) || 
                   !empty($sal) || 
                   !empty($sg) || 
                   !empty($sy)
                 ){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('admin_agegroups')->insert($aaa);
                    \DB::table('admin_civilstatuses')->insert($ccc);
                    \DB::table('admin_educattainments')->insert($att);
                    \DB::table('admin_eligibilitynames')->insert($elina);
                    \DB::table('admin_eligibilitynos')->insert($elino);
                    \DB::table('admin_empstatuses')->insert($emp);
                    \DB::table('admin_lastpromotionyrs')->insert($last);
                    \DB::table('admin_salarygrades')->insert($sal);
                    \DB::table('admin_servicegrps')->insert($sg);
                    \DB::table('admin_serviceyrs')->insert($sy);


                    //point computation
                    //get datas
            $univ = University::find($u);

             //  $cdate = \Carbon\Carbon::now();
              
             //  $rep = DB::table('report_weights')->where('name','Administrative')->pluck('id');
             //  $repdata= ReportWeight::find($rep);
             //  $value= $repdata->value;
             //  $ddate= new Carbon ($repdata->due_date);
             //  $ded = $repdata->deduction;
             //  $dedpday =$repdata->dayofdeduction;
             //  //Compute date days ded
             // // $difference=($cdate->diff($now)->day )
             //  $diff= $cdate->diffInDays($ddate);




         //     $univ['c_point'] = ;
           //    $univ['t_point'] = ;
              
              $univ->save();

            
                
                    dd('Insert Record successfully.');
                }
                else
                {
                  dd('You dont fill all.');
                }
            }

        }
        $cdate = \Carbon\Carbon::today();
          $rep = DB::table('report_weights')->where('name','Administrative')->pluck('id');
         // $data= ReportWeight::find($rep);
          $ddd=\Carbon\Carbon::parse($request->duedate);
              $ded= ReportWeight::find($rep)->pluck('deduction');
              $value= ReportWeight::find($rep)->pluck('value');
              $dd=ReportWeight::where('id',$rep)->pluck('due_date'); 
             //$aa=$ddd->diffInDays(\Carbon\Carbon::now()); 
              $aa=$dd->diffInDays($cdate);
              $day=ReportWeight::find($rep)->pluck('dayofdeduction');
              //Compute date days ded
             // $difference=($cdate->diff($now)->day )
             //$diff = $cdate->diffInDays($dd);
      //  dd($aa);   
      dd($aa,$ddd,$cdate); 
    } 
  



   public function exportAdmin(Request $r)
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
 

      $agegroup = array('25below','26to30','31to35',' 36to40','41to45','46to50','51to55','56to60','61above');
      $civilstatus = array('Single','Married','Widowed','Separated','Annulled');
      $attainment = array('ElementaryLevel','ElementaryGraduate','HighSchoolLevel','HighSchoolGraduate','Vocational','CollegeLevel','CollegeGraduate','Master','PhD');
      $eligibilitynames= array('CSprofessional','CSSubProfessional','Testimonial','Tesda','Others');
      $eligibilitynos =  array('With','Without');
      $empstatus =  array('CasualMale',' CasualFemale','PermanentMale',' PermanentFemale','PartTimeMale','PartTimeFemale');
      $lastpromotion = array('none','below1','1to5','6to10','11to15','16to20','21above');
      $salarygrade=array('1to5','6to10','11to15','16to20','21to25','26to30');
      $servicegroup= array('GeneralAdmin','Planning','MedicalHealth','EducationalArchival','DefenseSecurity','Others');
      $serviceyear= array('below1','1to5','6to10','11to15','16to20','21to25','26to30','31to35','36above');


                $agegroup_data = json_decode( json_encode($agegroup), true);
                $civilstatus_data = json_decode( json_encode($civilstatus), true);
                $attainment_data = json_decode( json_encode($attainment), true);
                $eligibilitynos_data = json_decode( json_encode($eligibilitynos), true);
                $eligibilitynames_data = json_decode( json_encode($eligibilitynames), true);
                $empstatus_data = json_decode( json_encode($empstatus), true);
                $lastpromotion_data = json_decode( json_encode($lastpromotion), true);
                $salarygrade_data = json_decode( json_encode($salarygrade), true);
                $servicegroup_data = json_decode( json_encode($servicegroup), true);   
                $serviceyear_data = json_decode( json_encode($serviceyear), true);             
                

      return Excel::create($name,function($excel) use($agegroup_data,$civilstatus_data,$attainment_data,$eligibilitynames_data,$eligibilitynos_data,$empstatus_data,$lastpromotion_data,$salarygrade_data,$servicegroup_data,$serviceyear_data){
        //$excel->setTitle('Higher Education');
          //put here the editor $excel->setCreator('Argie Joseph D. Bigornia')
                $excel->sheet('Admin Service Year',function($sheet) use($serviceyear_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($serviceyear_data);

              });

                $excel->sheet('Admin Service Group',function($sheet) use($servicegroup_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($servicegroup_data);

              });

                $excel->sheet('Admin Salary Grades',function($sheet) use($salarygrade_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($salarygrade_data);

              });


                $excel->sheet('Admin Last Promotion Year ',function($sheet) use($lastpromotion_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($lastpromotion_data);

              });

                $excel->sheet('Admin Employee Status',function($sheet) use($empstatus_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($empstatus_data);

              });

        $excel->sheet('Admin Eligibility Number',function($sheet) use($eligibilitynos_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($eligibilitynos_data);

              });
        //Higher Education
        $excel->sheet('Admin Eligibility Names',function($sheet) use($eligibilitynames_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($eligibilitynames_data);

              });

        $excel->sheet('Admin Educational Attainment',function($sheet) use($attainment_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($attainment_data);

              });

        $excel->sheet('Admin Civil Status',function($sheet) use($civilstatus_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($civilstatus_data);

              });
   
        $excel->sheet('Admin Age Group',function($sheet) use($agegroup_data){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

             $sheet->cells('E1:F1', function($cells) {
              $cells->setBackground('#64c764');

        });
            $sheet->cells('G1:H1', function($cells) {
              $cells->setBackground('#ecdc3d');

        });
          $sheet->cells('I1:J1', function($cells) {
              $cells->setBackground('#d2332a');

        });

           $sheet->cells('K1:L1', function($cells) {
              $cells->setBackground('#35ceca');

        });

            $sheet->cells('M1:N1', function($cells) {
              $cells->setBackground('#9ca9a9');

        });

            $sheet->cells('A1:D1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($agegroup_data);

              });

//Technical Program
             

              })->export('xlsx');
            }

}
