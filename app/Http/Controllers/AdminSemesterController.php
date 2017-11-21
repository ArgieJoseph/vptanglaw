<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;
use Auth;
use DB;


class AdminSemesterController extends Controller
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
         $this->middleware('Admin', ['only' => ['delete','edit','editStatus','updateStatus','update','data','getdatasearch','create','index']]);
       
     
    }


   public function index(Request $request)
    {
         $sems = Semester::paginate(5);

        if ($request->ajax()) {
            return view('tables.admin_semester_table', compact('sems'));
        }

        return view('pages.admin_semester',compact('sems'),array('user'=> Auth::user()));

    }


    public function create(Request $request)
    {

    	if ($request->ajax())
    	{
    		$sem = new Semester();
    		$sem['name'] = $request->name;
    		$sem['status'] = $request->status;
    		$sem->save();		

    	}
    	 return response(['msg'=>'Inserted Successfully!']);
    }




      public function search(Request $r)
    {
        if($r->ajax())
        {
            $output="";
     
            $sems = DB::table('semesters')
            ->select('id' ,'name','status')
            ->where('name','LIKE','%'.$r->search.'%')
            ->orWhere('status','LIKE','%'.$r->search.'%')
            ->paginate(5);

            if($sems)
                {
                    foreach ($sems as $key => $sem) {
                        $output.='<tr>'.
                                    '<td class="hidden">'.$sem->id.'</td>'.
                                    '<td>'.$sem->name.'</td>'.
                                    
                                    '<td>'.$sem->status.'</td>'.
                                    
                                    '<td>'.

                            '<button value="'.$sem->id.'"class="btn btn-primary btn-xs btn-edit" ><i class="fa fa-pencil-square-o"></i>
                            </button>
                            <button value="'.$sem->id.'"class="btn btn-danger btn-xs btn-dell"><i class="fa fa-trash"></i></button>'
                                .'</td>'.
                                    '</tr>';
                                    

                    }

                    return response($output);
                }
                else
                {
                    return response()->json(['no'=>'Not found!']);
                }
        }

    }



   		public function edit(Request $r)
    {
	        if($r->ajax())
	        {
	           $sems = Semester::find($r->id);

	            return $data=
                  [
                  	'id' => $r->id ,  
                   	'status' => $sems->status,
                   	'name' => $sems->name
                  ];
	        }
    }



   public function update(Request $r)
    {
          

          if ($r->ajax())
        {

              $sems = Semester::find($r['id']);
              $sems['name'] = $r['name'];
              $sems['status'] = $r['status'];
           	  $sems->save();
                
        }
         return response(['msg'=>'Updated Successfully!']);
    }


   		public function editStatus(Request $r)
    {
	        if($r->ajax())
	        {
	           $sems = Semester::find($r->id);

	            return $data=
                  [
                  	'id' => $r->id , 
                   	'status' => $sems->status,
                   	'name' => $sems->name
                  ];

	        }
	        return view('pages.admin_semester',compact('sems'));
    }


    public function updateStatus(Request $r)
    {     
          if ($r->ajax())
        {
              $sems = Semester::find($r['id']);
              if($r['status'] == '1'){
              $sems['status'] = '0';
           
           	}
           	else{
           		  $affected = DB::table('semesters')->where('status', '=', 1)->update(array('status' => 0));
           		$sems['status'] = '1';
           	 	
           	}
            $sems->save();
        }
         return response(['msg'=>'Updated Successfully!']);
    }

    public function delete(Request $r)
    {
        if($r->ajax())
        {
          $s_id =Semester::find($r->id);
          if($s_id->status==1)
          {
              return response(['msg'=>'You cannot delete active semester!']);

          }
          else
          {

            Semester::destroy($r->id);        
            return response(['msg'=>'Deleted Successfully!']);

          }

            
        }
    }

}
