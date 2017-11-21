<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\TUniversity;
use App\Category;
use App\University;
use App\SchoolYear;
use App\Semester;
use App\Enrollment;


class AdminTechnicalProgramController extends Controller
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
        $this->middleware('Admin', ['only' => ['delete','edit','update','data','getdatasearch','create','index']]);
       
     
    }


    public function index(Request $request)
    {

         $univs = University::pluck('name','id');

         $offered= DB::table('t_universities')
         	->join('universities','t_universities.u_id','=','universities.id')
         	->join('categories','universities.c_id','=','categories.id')
         	->select('t_universities.id AS id','universities.code','categories.name as type', 't_universities.course','t_universities.major')
         	->where('t_universities.education','Technical Program')
         	->paginate(5);

            if ($request->ajax()) {
           return view('tables.admin_technical_table', compact('offered'));
        }

           //return view('pages.admin_campus',compact('univs'));   
        return view('pages.admin_program_technical',compact('univs','offered'),array('user'=> Auth::user()));
 //return view('pages.admin_campus',['categorys'=>Category::pluck('name','id')],array('user'=> Auth::user()));

    }


    public function create(Request $r)
    {
    	$a_sy = SchoolYear::where('status',1)
    			->value('id');

    	$a_sem = Semester::where('status',1)
    			->value('id');

        if ($r->ajax())
        {
            $t_u = new TUniversity();
            $t_u['u_id'] = $r->u_id;
            $t_u['sy_id'] = $a_sy;
            $t_u['sem_id'] = $a_sem;
            $t_u['education'] ='Technical Program'; 
            $t_u['major'] = $r->major;
            $t_u['course'] = $r->course;
            if($t_u->save())
            {
                $tu = DB::table('t_universities')
                        ->where('u_id',$r->u_id)
                        ->where('sy_id',$a_sy)
                        ->where('sem_id',$a_sem)
                        ->where('education','Technical Program')
                        ->where('major',$r->major)
                        ->where('course',$r->course)
                        ->value('id'); 

                $e = new Enrollment();
                $e['tu_id'] = $tu;
                $e->save();                
            }
        }
    }



    public function edit(Request $r)
    {
        if($r->ajax())
        {

          $t_u = TUniversity::find($r->id);

          return $data=

                 [
                  'id' => $r->id ,  
                  'u_id' => $t_u->u_id,  
                  'course' => $t_u->course,   
                  'major' => $t_u->major
                 ];
        }
    }


  public function update(Request $r)
    {
          if ($r->ajax())
        {
           $offered = TUniversity::find($r->id);

		        $offered['id'] = $r['id'];
		        $offered['course'] = $r['name'];
		        $offered['major'] = $r['mname'];
		        $offered['u_id'] = $r['univ_id'];
		        $offered->save();
		    
		    return response(['msg'=>'Update Successfully!']);
   		}		                	
}
                                  
        
    
    public function delete(Request $r)
    {
        if($r->ajax())
        {

            TUniversity::destroy($r->id);

            return response(['id'=>$r->id]);
            
        }
        return response(['msg'=>'Delete Successfully!']);
    }

}


