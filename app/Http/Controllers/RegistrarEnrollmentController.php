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
use App\University;

class RegistrarEnrollmentController extends Controller
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
 $offered = DB::table('report_weights')->where('name','Administrative')->get();
          return view('pages.rg_enrollment',compact('offered'),array('user'=> Auth::user()));
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
      ->where('t_universities.education','Higher Education')
      ->where('t_universities.sem_id',$sem)
      ->where('t_universities.sy_id',$sys)
      ->where('t_universities.u_id',$u)
      ->value('t_universities.id');


          $name=DB::table('universities')
          ->where('id',$u)
          ->value('code');
 


      $bump = DB::table('enrollments')
      ->join('t_universities','enrollments.tu_id','=','t_universities.id')
      ->join('universities','t_universities.u_id','=','universities.id')
                ->select('enrollments.id AS Id','enrollments.tu_id as UID','course as Course','major AS Major',
                  '1stmale AS stMale','1stfemale AS stFemale',
                  '2ndmale AS ndMale  ','2ndfemale AS ndFemale',
                  '3rdmale AS rdMale','3rdfemale AS rdFemale',
                  '4thmale AS rthMale', '4thfemale AS rthFemale',
                  '5thmale AS fthMale','5thfemale AS fthFemale')
                ->where('t_universities.education','Higher Education')
                ->where('t_universities.u_id',$u)
                ->where('t_universities.sem_id',$sem)
                ->where('t_universities.sy_id',$sys)
                ->get();

        $tp_data = DB::table('enrollments')
              ->join('t_universities','enrollments.tu_id','=','t_universities.id')
              ->join('universities','t_universities.u_id','=','universities.id')
                ->select('enrollments.id AS Id','enrollments.tu_id as UID','course as Course','major AS Major',
                  '1stmale AS stMale','1stfemale AS stFemale',
                  '2ndmale AS ndMale  ','2ndfemale AS ndFemale',
                  '3rdmale AS rdMale','3rdfemale AS rdFemale',
                  '4thmale AS rthMale', '4thfemale AS rthFemale',
                  '5thmale AS fthMale','5thfemale AS fthFemale')
                ->where('t_universities.education','Technical Program')
                ->where('t_universities.u_id',$u)
                ->where('t_universities.sem_id',$sem)
                ->where('t_universities.sy_id',$sys)
                ->get();

                $bumps = json_decode( json_encode($bump), true);
                $tp_datas = json_decode( json_encode($tp_data), true);

      return Excel::create($name,function($excel) use($bumps,$tp_datas){
        //$excel->setTitle('Higher Education');
          //put here the editor $excel->setCreator('Argie Joseph D. Bigornia')

        //Higher Education
   
        $excel->sheet('Higher Education',function($sheet) use($bumps){
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

              
                  $sheet->fromArray($bumps);

              });

//Technical Program
                $excel->sheet('Technical Program',function($sheet) use($tp_datas){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'


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

              
                  $sheet->fromArray($tp_datas);

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
            $he = \Excel::selectSheetsByIndex(0)->load($path)->get();
            $tp = \Excel::selectSheetsByIndex(1)->load($path)->get();


            if($he->count() || $tp->count()){
                foreach ($he as $key  => $value) {
                    $arrhe[] = [
                      'id'=> $value->id,
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
                     '5thfemale' => $value->fthfemale
                      
                   ];
                 TEnrollment::where('id',$value->id )->delete();
                }

                foreach ($tp as $key  => $value) {
                    $arrtp[] = [
                      'id'=> $value->id,
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
                     '5thfemale' => $value->fthfemale
                      
                   ];
                   TEnrollment::where('id', $value->id)->delete();
                }
                if(!empty($arrhe) || !empty($arrtp) ){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('t_enrollments')->insert($arrhe);
                    \DB::table('t_enrollments')->insert($arrtp);
                
         //currentdate
          $cdate = \Carbon\Carbon::today();
//getting id of report to provide values
          $rep = DB::table('report_weights')->where('name','Enrollment')->pluck('id');
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

              $adminid=DB::table('t_enrollments')->where('tu_id',$nid)->value('id');


            
              //completeness(increment[will depend on how many times they will import or change the data they submitted])
            // DB::table('admin_empstatuses')->whereId($adminid)->increment('c_point');
              $unive=University::find($u);
              $unive['c_point']= $unive['c_point']+1;
             
              $unive->save();
  
              $univ=TEnrollment::find($adminid);
              $univ['t_point'] = $tvalue;
             
              $univ->save();
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
