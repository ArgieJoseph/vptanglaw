<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Excel;
use App\Licensure;
use App\University;

class IPOLicensureController extends Controller
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
    public function licensure(Request $request)
    {
         
        $branch= DB::table('universities')
            ->pluck('name','id');
             $offered = DB::table('report_weights')->where('name','Licensure')->get();

          return view('pages.ipo_import_licensure',compact('branch','offered'),array('user'=> Auth::user()));
    }



      public function exportLicensure(Request $r)
    {
    	 $u=$r->id;
      
      $name=DB::table('universities')
          ->where('id',$u)
          ->value('code');

         

		 $licensure = array('ExamName','Month','NationalPasser','NationalExaminee','PUPPasser','PUPExaminee','Placer');

                $bumps = json_decode( json_encode($licensure), true);
               

      return Excel::create($name,function($excel) use($bumps){
        //$excel->setTitle('Higher Education');
          //put here the editor $excel->setCreator('Argie Joseph D. Bigornia')

        //Higher Education
   
        $excel->sheet('Lincensure',function($sheet) use($bumps){
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

              })->export('xlsx');
            }




         public function import(Request $request){


              if($request->hasFile('sample_file')){
                      
                      $u=$request->id;
                      $y=$request->year;
   
        
            $path = $request->file('sample_file')->getRealPath();
            $li = \Excel::selectSheetsByIndex(0)->load($path)->get();
            


            if($li->count()){
                foreach ($li as $key  => $value) {
                    $arrli[] = [
                      'u_id' => $u,
                      'exam_name' => $value->examname,
                     'month' => $value->month,
                     'natl_passer' => $value->nationalpasser,
                     'natl_examinee' => $value->nationalexaminee,
                     'pup_passer' => $value->puppasser,
                     'pup_examinee' => $value->pupexaminee,
                     'placer' => $value->placer,
                      'year'=> $y
                      
                   ];
                 Licensure::where('u_id', $arrli[0])->delete();
                }
            
                
                if(!empty($arrli) ){
                    \DB::table('licensures')->insert($arrli);
                //currentdate
          $cdate = \Carbon\Carbon::today();
//getting id of report to provide values
          $rep = DB::table('report_weights')->where('name','Licensure')->pluck('id');
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
                                          

              $adminid= DB::table('licensures')->where('u_id',$u)
                                        ->where('year',$y)->value('id');

              //completeness(increment[will depend on how many times they will import or change the data they submitted])
            // DB::table('admin_empstatuses')->whereId($adminid)->increment('c_point');
              $unive=University::find($u);
              $unive['c_point']= $unive['c_point']+1;
             
              $unive->save();
  
              $univ=Licensure::find($adminid);
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
