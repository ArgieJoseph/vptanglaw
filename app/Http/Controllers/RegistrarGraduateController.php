<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;
use App\Graduate;

class RegistrarGraduateController extends Controller
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

          return view('pages.rg_graduate',array('user'=> Auth::user()));
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
               

        
            $path = $request->file('sample_file')->getRealPath();
            $grad = \Excel::selectSheetsByIndex(0)->load($path)->get();
           


            if($grad->count()){
                foreach ($grad as $key  => $value) {
                    $arrgrad[] = [
                      'tu_id' => $value->id,
                     'male' => $value->male,
                     'female' => $value->female,
                     'mid_end' => $my,
                     'year'=>$y,
                      'created_at' =>  \Carbon\Carbon::now(), # \Datetime()
            		'updated_at' => \Carbon\Carbon::now()
                      
                   ];
                     

                      DB::table('graduates')->where('tu_id',$value->id)
                                            ->where('year',$y)
                                            ->where('mid_end',$my)
                                            ->delete();
                }

             
                if(!empty($arrgrad) ){
                 // \DB::table('t_enrollments')->detele();
                    \DB::table('graduates')->insert($arrgrad);
       
                
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
