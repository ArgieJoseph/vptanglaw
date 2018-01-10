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

class RegistrarFacilityController extends Controller
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

          return view('pages.rg_facility',array('user'=> Auth::user()));
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

		 $building = array('BuildingName','Area');
		 $capacity = array('FacilityName','Capacity');
		 $distance = array('Distance');
		 $laboratories = array('LaboratoryName','Room','Capacity');
		 $landarea = array('Landarea');
		 $room = array('Classroom','Administrative','Academic','FacultyLounge');
		 $sport = array('SportsFacility','Area');
     $library = array('Textbook','Periodical','Cd','Others');


		 $building_data = json_decode( json_encode($building), true);
		 $capacity_data = json_decode( json_encode($capacity), true);
		 $distance_data = json_decode( json_encode($distance), true);
		 $laboratories_data = json_decode( json_encode($laboratories), true);
		 $landarea_data = json_decode( json_encode($landarea), true);
		 $room_data = json_decode( json_encode($room), true);
		 $sport_data = json_decode( json_encode($sport), true);
     $library_data = json_decode( json_encode($library), true);


      return Excel::create($name,function($excel) use($building_data,$capacity_data,$distance_data,$laboratories_data,$landarea_data,$room_data,$sport_data,$library_data){
        //$excel->setTitle('Higher Education');
          //put here the editor $excel->setCreator('Argie Joseph D. Bigornia')
        $excel->sheet('Facility Building',function($sheet) use($building_data){
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

              
                  $sheet->fromArray($building_data);

              });

//Technical Program
                $excel->sheet('Facility Capacity',function($sheet) use($capacity_data){
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

              
                  $sheet->fromArray($capacity_data);

              });




      	  $excel->sheet('Facility Room',function($sheet) use($room_data){
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

              
                  $sheet->fromArray($room_data);

              });


        
          $excel->sheet('Facility Sport',function($sheet) use($sport_data){
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

              
                  $sheet->fromArray($sport_data);

              });

      	        $excel->sheet('Facility LandArea',function($sheet) use($landarea_data){
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

              
                  $sheet->fromArray($landarea_data);

              });

        $excel->sheet('Facility Laboratories',function($sheet) use($laboratories_data){
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

              
                  $sheet->fromArray($laboratories_data);

              });

        $excel->sheet('Facility Distance',function($sheet) use($distance_data){
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

              
                  $sheet->fromArray($distance_data);

              });
        
                $excel->sheet('Library Holdings',function($sheet) use($library_data){
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

              
                  $sheet->fromArray($library_data);

              });
   




              })->export('xlsx');
            }

 public function import(Request $request){

              if($request->hasFile('sample_file')){
               
                $y = $request->year;
               
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
            $building = \Excel::selectSheetsByIndex(0)->load($path)->get();
            $capacity = \Excel::selectSheetsByIndex(1)->load($path)->get();
            $room = \Excel::selectSheetsByIndex(2)->load($path)->get();
            $sport = \Excel::selectSheetsByIndex(3)->load($path)->get();
            $landarea = \Excel::selectSheetsByIndex(4)->load($path)->get();
            $laboratory = \Excel::selectSheetsByIndex(5)->load($path)->get();
            $distance = \Excel::selectSheetsByIndex(6)->load($path)->get();
            $libholding = \Excel::selectSheetsByIndex(7)->load($path)->get();
          
            


            //$tp = \Excel::selectSheetsByIndex(1)->load($path)->get();
     //             $building = array('BuildingName','Area');
     // $capacity = array('FacilityName','Capacity');
     // $distance = array('Distance');
     // $laboratories = array('LaboratoryName','Room','Capacity');
     // $landarea = array('Landarea');
     // $room = array('Classroom','Administrative','Academic','FacultyLounge');
     // $sport = array('SportsFacility','Area');


            if(
                $building->count() || 
                $capacity->count() || 
                $distance->count() || 
                $libholding->count() || 
                $laboratory->count() || 
                $sport->count() || 
                $room->count() || 
                $landarea->count()
              ){


            foreach ($landarea as $key  => $value) {
                    $land[] = [
          
                     'u_id' => $u,
                     'land_area' => $value->landarea,
                     'year' => $y


                   ];
               
                DB::table('facility_landareas')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }


             foreach ($room as $key  => $value) {
                    $r[] = [
          
                     'u_id' => $u,
                     'classroom' => $value->classroom,
                     'administrative' => $value->administrative,
                     'academic' => $value->academic,
                     'faculty_lounge' => $value->facultylounge,
                     'year' => $y


                   ];
               
                DB::table('facility_rooms')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }

            foreach ($sport as $key  => $value) {
                    $s[] = [
          
                     'u_id' => $u,
                     'sports_facility' => $value->sportsfacility,
                     'area' => $value->area,
                     'year' => $y


                   ];
               
                DB::table('facility_sports')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }


            foreach ($laboratory as $key  => $value) {
                    $la[] = [
          
                     'u_id' => $u,
                     'lab_name' => $value->laboratoryname,
                     'room' => $value->room,
                     'capacity' => $value->capacity,
                     'year' => $y


                   ];
               
                DB::table('facility_laboratories')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }

            foreach ($libholding as $key  => $value) {
                    $l[] = [
          
                     'u_id' => $u,
                     'textbook' => $value->textbook,
                     'periodical' => $value->periodical,
                     'cd' => $value->cd,
                     'others' => $value->others,
                     'year' => $y


                   ];
               
                DB::table('facility_libholdings')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }


            foreach ($distance as $key  => $value) {
                    $d[] = [
          
                     'u_id' => $u,
                     'distance' => $value->distance,
                     'year' => $y


                   ];
               
                DB::table('facility_distances')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }


            foreach ($capacity as $key  => $value) {
                    $c[] = [
          
                     'u_id' => $u,
                     'facility_name' => $value->facilityname,
                     'capacity' => $value->capacity,
                     'year' => $y


                   ];
               
                DB::table('facility_capacities')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }


              foreach ($building as $key  => $value) {
                    $b[] = [
          
                     'u_id' => $u,
                     'building_name' => $value->buildingname,
                     'area' => $value->area,
                     'year' => $y


                   ];
               
                DB::table('facility_buildings')->where('u_id',$u)
                                            ->where('year',$y)
                                            ->delete();
                }
                   if(!empty($b) || !empty($c) || 
                    !empty($d) || !empty($l) || 
                    !empty($la) || !empty($s) || 
                    !empty($r) || !empty($land)){
                
                    \DB::table('facility_buildings')->insert($b);
                    \DB::table('facility_capacities')->insert($c);
                    \DB::table('facility_distances')->insert($d);
                    \DB::table('facility_libholdings')->insert($l);
                    \DB::table('facility_laboratories')->insert($la);
                    \DB::table('facility_sports')->insert($s);
                    \DB::table('facility_rooms')->insert($r);
                    \DB::table('facility_landareas')->insert($land);





            
                
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
