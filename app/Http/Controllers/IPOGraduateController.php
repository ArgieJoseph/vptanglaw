<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;
use App\Graduate;
use App\University;


class IPOGraduateController extends Controller
{
    //
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
    public function graduate(Request $request)
    {
         
        $branch= DB::table('universities')
            ->pluck('name','id');
             $offered = DB::table('report_weights')->where('name','Graduate')->get();

          return view('pages.ipo_import_graduate',compact('branch','offered'),array('user'=> Auth::user()));
    }





          public function exportGraduate(Request $r)
    {
    	$sem=DB::table('semesters')
        ->where('status',1)
        ->value('id');

           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');

           $u=$r->id;

      $bump = DB::table('t_universities')
      ->join('semesters','t_universities.sem_id','=','semesters.id')
      ->join('school_years','t_universities.sy_id','=','school_years.id')
      ->join('universities','t_universities.u_id','=','universities.id')
      ->select('t_universities.id AS Id','course as Course','major AS Major')
      ->where('t_universities.sem_id',$sem)
      ->where('t_universities.sy_id',$sys)
      ->where('t_universities.u_id',$u)
      ->get();


          $name=DB::table('universities')
          ->where('id',$u)
          ->value('code');
 


                  $bumps = json_decode( json_encode($bump), true);
               

      return Excel::create($name,function($excel) use($bumps){
        //$excel->setTitle('Higher Education');
          //put here the editor $excel->setCreator('Argie Joseph D. Bigornia')

        //Higher Education
   
        $excel->sheet('Graduate',function($sheet) use($bumps){
          // $sheet->fromArray(array(array('Polytechnic University of the Philippines Sta. Mesa, Manila'),
          // array('Higher Education Enrollees'

            $sheet->cell('D1', function($cell) {
              $cell->setBackground('#d2332a');
              $cell->setValue('Male');

        });
             $sheet->cell('E1', function($cell) {
              $cell->setBackground('#d2332a');
              $cell->setValue('Female');

        });

            $sheet->cells('A1:C1', function($cells) {
              $cells->setBackground('#aeeeec');

        });

              
                  $sheet->fromArray($bumps);

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
      $u=$request->id;
           $sys=DB::table('school_years')
        ->where('status',1)
        ->value('id');
               

        
            $path = $request->file('sample_file')->getRealPath();
            $grad = \Excel::selectSheetsByIndex(0)->load($path)->get();
           


            if($grad->count()){
                foreach ($grad as $key  => $value) {
                    $arrgrad[] = [
                      'tu_id' => $value->id,
                     'male' => $value->male,
                     'female' => $value->female,
                     'mid_end' => $my,
                     'year'=>$y
                      
                   ];
                     

                      DB::table('graduates')->where('tu_id',$value->id)
                                            ->where('year',$y)
                                            ->where('mid_end',$my)
                                            ->delete();
                }

             
                if(!empty($arrgrad) ){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('graduates')->insert($arrgrad);
       
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

              $adminid= DB::table('graduates')->where('tu_id',$nid)
                                        ->where('mid_end',$my)
                                        ->where('year',$y)->value('id');

              //completeness(increment[will depend on how many times they will import or change the data they submitted])
            // DB::table('admin_empstatuses')->whereId($adminid)->increment('c_point');
              $unive=University::find($u);
              $unive['c_point']= $unive['c_point']+1;
             
              $unive->save();
  
              $univ=Graduate::find($adminid);
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
