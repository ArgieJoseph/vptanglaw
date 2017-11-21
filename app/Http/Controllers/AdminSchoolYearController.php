<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolYear;
use Auth;
use DB;

class AdminSchoolYearController extends Controller
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
         $sy = SchoolYear::paginate(5);
         
                if ($request->ajax()) {
            return view('tables.admin_sy_table', compact('sy'));
        }
        return view('pages.admin_schoolyear',compact('sy'),array('user'=> Auth::user()));

    }


    public function create(Request $request)
    {

    	if ($request->ajax())
    	{
    		$sy = new SchoolYear();
    		$sy['start_date'] = $request->start_date;
    		$sy['end_date'] = $request->end_date;

    		$sy['status'] = $request->status;
    		$sy->save();    			

    	}
    	 return response(['msg'=>'Inserted Successfully!']);
    }


  public function delete(Request $r)
    {
        if($r->ajax())
        {

          $s_id =SchoolYear::find($r->id);
          if($s_id->status==1)
          {
              return response(['msg'=>'You cannot delete active School Year!']);

          }
          else
          {

            SchoolYear::destroy($r->id);        
            return response(['msg'=>'Deleted Successfully!']);

          }

            
        }

    }


    
      public function editStatus(Request $r)
    {
          if($r->ajax())
          {
             $sy = SchoolYear::find($r->id);

              return $data=
                  [
                    'id' => $r->id , 
                    'status' => $sy->status,
                    'start_date' => $sy->start_date,
                    'end_date' => $sy->end_date,
                  ]; 
          }
          return view('pages.admin_schoolyear',compact('sy'));
    }


    public function updateStatus(Request $r)
    {
          
          if ($r->ajax())
        {
              $sy = SchoolYear::find($r['id']);
              if($r['status'] == '1'){
              $sy['status'] = '0';
           	  
           	}
           	else{
           		
              $affected = DB::table('school_years')->where('status', '=', 1)->update(array('status' => 0));
           		$sy['status'] = '1';
           	 	
           	}
          $sy->save();
           return response(['msg'=>'Updated Successfully!']);     
        
         
    }
  }

   




      public function edit(Request $r)
    {
          if($r->ajax())
          {
             $sy = SchoolYear::find($r->id);

              return $data=
                  [
                  'id' => $r->id , 
                    'status' => $sy->status,
                    'start_date' => $sy->start_date,
                    'end_date' => $sy->end_date,
                  ];
          }
    }



   public function update(Request $r)
    {
          if ($r->ajax())
        {
              $sy = SchoolYear::find($r['id']);
              $sy['start_date'] = $r['startYear'];
               $sy['end_date'] = $r['endYear'];
              $sy['status'] = $r['status'];
              $sy->save();
        }
         return response(['msg'=>'Updated Successfully!']);
    }


  public function get_data_search(Request $r)
    {
       if($r->ajax())
       {

        $sy=$this->data($r['search']);
        
	        if(!(empty($r['search'])))
	        {
	            $search=$r['search'];
	            $view=view('tables.admin_sy_table',compact('sy','search'))->render();
	            return response($view);
	        }
    }

          
        
    }

  public function data($search)
    {
       $sy = SchoolYear::paginate(5);
      return $sy = DB::table('school_years')
            ->where('start_date','LIKE','%'.$search.'%')
            ->orWhere('end_date','LIKE','%'.$search.'%')
            ->paginate(5);
        
    }

      public function getdatasearch(Request $r)
        {
          if($r->ajax()){
             $sy=$this->data($r['search']);
             return view('tables.admin_sy_table',compact('sy'))->render();
          }
        }


}
