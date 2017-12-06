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

          return view('pages.ipo_import_admin',compact('semester','sy','branch'),array('user'=> Auth::user()));
    }


    public function importAdmin(Request $request){

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
 

      $agegroup = array('25-below','26-30','31-35',' 36-40','41-45','46-50','51-55','56-60','61-above');
      $civilstatus = array('single','married','widowed','separated','annulled');
      $attainment = array('elem_level','elem_grad','hs_level','hs_grad','vocational','college_level','college_grad','master','phd');
      $eligibilitynames= array('cs_pro','cs_subpro','testimonial','tesda','others');
      $eligibilitynos =  array('with','without');
      $empstatus =  array('casual_male',' casual_female','permanent_male',' permanent_female','pt_male','pt_female');
      $lastpromotion = array('none','below 1','1-5','6-10','11-15','16-20','21-above');
      $salarygrade=array('1-5','6-10','11-15','16-20','21-25','26-30');
      $servicegroup= array('gen_admin','planning','med_health','edu_archival','defense_security','others');
      $serviceyear= array('below1','1-5','6-10','11-15','16-20','21-25','26-30','31-35','36-above');


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
