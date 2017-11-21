<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\University;
use DB;

class AdminAdvanceProgramController extends Controller
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
        $this->middleware('Admin');
       
     
    }


    public function index(Request $request)
    {
         $univs = University::pluck('name','id');

         $categorys= Category::pluck('name','id');

         $offered= DB::table('t_universities')
         	->join('universities','t_universities.u_id','=','universities.id')
         	->join('categories','universities.c_id','=','categories.id')
         	->select('t_universities.id AS id','categories.name as type', 't_universities.education', 't_universities.course','t_universities.major');


             if ($request->ajax()) {
            return view('tables.admin_advance_table', compact('offered'));
        }

           //return view('pages.admin_campus',compact('univs'));   
        return view('pages.admin_program_advance',compact('univs','colleges','offered'),array('user'=> Auth::user()));
 //return view('pages.admin_campus',['categorys'=>Category::pluck('name','id')],array('user'=> Auth::user()));

    }


    public function create(Request $request)
    {

        if ($request->ajax())
        {
            $program_details = new ProgramDetails();
            $program_details['name'] = $request->name;
            $name = $request->name;
            $c_id=$request->colleges_id;


            if($program_details->save())
            {
                $program_details_id = DB::table('program_details')
                        ->where('program_details.name',$name)
                            ->value('id');
                $programs= new Program();
                $programs['program_details_id']=$program_details_id;
                $programs['name']=$request->mname;



            }
                if($programs->save())
                {
                     $program_id = DB::table('programs')
                    ->join('program_details','programs.program_details_id','=','program_details.id')
                        ->where('program_details.name',$name)
                      
                            ->value('programs.id');
                     $college_programs = new CollegeProgram();
                     $college_programs['college_id']= $c_id;
                     $college_programs['program_id']= $program_id;
                    // $program_specializations->save()

                     //return response(['msg'=>'Inserted Successfully!']);
                     if($college_programs->save())
                     {
                        $cp_id=DB::table('college_programs')
                            ->where('college_id',$c_id)
                            ->where('program_id',$program_id)
                                ->value('id');

                        $offered = new OfferedCollegeByUniversity();
                        $offered['university_id']= $request->univ_id;
                        $offered['college_program_id']=$cp_id;
                        $offered->save();

                     }
                }


        }
    }



    public function edit(Request $r)
    {
        if($r->ajax())
        {

         /*  return $offered= DB::table('offered_college_by_universities')
            ->join('category_univs','offered_college_by_universities.university_id','=','category_univs.id')
            ->join('univs','category_univs.univ_id','=','univs.id')
            ->join('college_programs','offered_college_by_universities.college_program_id','=','college_programs.id')
            ->join('colleges','college_programs.college_id','=','colleges.id')
            ->join('college_details','colleges.college_detail_id','=','college_details.id')
           // ->join('programs','college_programs.program_id','=','programs.id')
            //->join('program_details','programs.program_details_id','=','program_details.id')
            ->where('offered_college_by_universities.id',$r->id)
            ->pluck('college_details.id AS colleges_id','univs.id AS univ_id');*/
          $offered = OfferedCollegeByUniversity::find($r->id);

          return $data=
                 ['id' => $r->id ,  
                  'univ_id' => $offered->university_id,  
                  'colleges_id' => $offered->college_program->college->college_detail_id,
                  'p_id' => $offered->college_program->program->program_detail->id,
                  
                   'cp_id' => $offered->college_program->id,
                   'c_id' => $offered->college_program->college_id,
                  'name' => $offered->college_program->program->program_detail->name
                  ];
          // $cat= Category_Univ::find($r->id)->category;
                  //return response(Category_Univ::find($r->id));
                //return response($cat); 
        }
    }


  public function update(Request $r)
    {
          

          if ($r->ajax())
        {
           $offered = OfferedCollegeByUniversity::find($r->id);
              $pd = ProgramDetails::find($r['p_id']);
              $pd['name'] = $r['name'];

            if ($pd->save())
            {
                    $c=CollegeProgram::find($r['cp_id']);
                    $c['college_id']=$r['colleges_id'];

                if($c->save())
                {
                    $offered['id'] = $r['id'];
                    $offered['university_id'] = $r['univ_id'];
                    $offered['college_program_id'] = $r['cp_id'];
                     $offered->save();
                       return response(['msg'=>'Update Successfully!']);
                }
            }
            
           // return $data;
                   
                   //  $cat_univ->save();

                     
                    // return response(['msg'=>'Update Successfully!']);
                
        }
    }




    public function delete(Request $r)
    {
        if($r->ajax())
        {
            //Univ::destroy($id);
            OfferedCollegeByUniversity::destroy($r->id);
            return response(['id'=>$r->id]);
            
        }
        return response(['msg'=>'Delete Successfully!']);
    }


 public function getdatasearch(Request $r)
        {
          if($r->ajax()){
             $adv=$this->data($r['search']);
             return view('tables.admin_advance_table',compact('adv'))->render();
          }
        }


    


      public function data($search)
    {

           return $offered= DB::table('offered_college_by_universities')
            ->join('category_univs','offered_college_by_universities.university_id','=','category_univs.id')
            ->join('univs','category_univs.univ_id','=','univs.id')
            ->join('college_programs','offered_college_by_universities.college_program_id','=','college_programs.id')
            ->join('colleges','college_programs.college_id','=','colleges.id')
            ->join('college_details','colleges.college_detail_id','=','college_details.id')
            ->join('programs','college_programs.program_id','=','programs.id')
            ->join('program_details','programs.program_details_id','=','program_details.id')
            ->select('offered_college_by_universities.id','univs.name AS uname','college_details.name AS cname','program_details.name AS pname')
            ->where('colleges.education_level_id', '=','1')
             ->orWhere('univs.name','LIKE','%'.$search.'%')
            ->orWhere('college_details.name','LIKE','%'.$search.'%')
            ->orWhere('program_details.name','LIKE','%'.$search.'%')
            ->paginate(5);

           //return view('tables.admin_campus_table',compact('univs'));   
            //return response (['msg'=>'View Successfully!']);
        
    }


}
