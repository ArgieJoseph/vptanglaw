<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\role;
use App\User;
use App\Admin;
use App\role_admin;
use DB;
use App\ReportWeight;

class AdminPerformancePointsController extends Controller
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
         $this->middleware('Admin', ['only' => ['delete','edit','editStatus','updateStatus','update','data','getdatasearch','myformPost','index']]);
       
     
    }

    public function index(Request $request)
    {
   
      $reports = DB::table('report_weights')->where('status',1)->paginate(10);

    	$report=ReportWeight::where('status',0)->pluck('name','id');
    	

    	  if ($request->ajax()) {
            return view('tables.admin_points_table', compact('reports'));
        }
    return view('pages.admin_performance_points',compact('report','reports'),array('user'=> Auth::user()));
    }



public function search(Request $r)
    {
        if($r->ajax())
        {
            $output="";
            $category="";
            $univs = DB::table('category_univs')
            ->join('univs', 'category_univs.univ_id', '=', 'univs.id')
            ->join('categorys', 'category_univs.category_id', '=', 'categorys.id')
            ->select('category_univs.id AS id','univs.id AS uid' ,'univs.code','categorys.name AS type' ,'univs.name','univs.address')
            ->where('categorys.name','LIKE','%'.$r->search.'%')
            ->orWhere('univs.code','LIKE','%'.$r->search.'%')
            ->orWhere('univs.name','LIKE','%'.$r->search.'%')
            ->orWhere('univs.address','LIKE','%'.$r->search.'%')
            ->paginate(5);

            if($univs)
                {
                    foreach ($univs as $key => $univ) {
                        $output.='<tr>'.
                                    '<td class="hidden">'.$univ->id.'</td>'.
                                    '<td class="hidden">'.$univ->uid.'</td>'.
                                    '<td>'.$univ->code.'</td>'.
                                    '<td>'.$univ->type.'</td>'.
                                    '<td>'.$univ->name.'</td>'.
                                    
                                    '<td>'.$univ->address.'</td>'.
                                    
                                    '<td>'.

                            '<button value="'.$univ->id.'"class="btn btn-primary btn-xs btn-edit" ><i class="fa fa-pencil-square-o"></i>
                            </button>
                            <button value="'.$univ->id.'"class="btn btn-danger btn-xs btn-dell"><i class="fa fa-trash"></i></button>'
                                .'</td>'.
                                    '</tr>';
                                    

                    }

                    return response($output);
                }else
                {
                    return response()->json(['no'=>'Not found!']);
                }
        }

    }


      public function get_data_search(Request $r)
    {
       if($r->ajax())
       {
        $admin=$this->data($r['search']);
        if(!(empty($r['search'])))
        {
            $search=$r['search'];
            $view=view('tables.admin_user_table',compact('admin','search'))->render();
            return response($view);
        }
       }

          
        
    }

     public function getdatasearch(Request $r)
        {
          if($r->ajax()){
             $admin=$this->data($r['search']);
             return view('tables.admin_user_table',compact('admin'))->render();
          }
        }


    


      public function data($search)
    {
      return $admin= DB::table('role_admins')
    		->join('roles','role_admins.role_id','=','roles.id')
    		->join('admins','role_admins.admin_id','=','admins.id')
    		->select('role_admins.role_id as role_id','admins.status as status','role_admins.id AS id','admins.fname AS fname','admins.mname AS mname','admins.lname AS lname','roles.name AS rname','admins.email AS email')
            ->where('roles.name','LIKE','%'.$search.'%')
            ->orWhere('admins.fname','LIKE','%'.$search.'%')
            ->orWhere('admins.mname','LIKE','%'.$search.'%')
            ->orWhere('admins.lname','LIKE','%'.$search.'%')
            ->paginate(5);

           //return view('tables.admin_campus_table',compact('univs'));   
            //return response (['msg'=>'View Successfully!']);
        
    }


      public function edit(Request $r)
    {
          if($r->ajax())
          {
             $ra = ReportWeight::find($r->id);

              return $data=
                  [
                    'id' => $r->id, 
                    'name' => $ra->name,
                    'value'=>$ra->value,
                    'due_date'=>$ra->due_date,
                    'deduction'=>$ra->deduction,
                    'dod'=>$ra->dayofdeduction
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

              $rep = ReportWeight::find($r['id']);
             
              $rep['value'] = $r['reportvalue'];
              $rep['due_date'] = $r['duedate'];
              $rep['deduction'] = $r['deduction'];
              $rep['dayofdeduction'] = $r['day'];
              $rep['status']=1;

              $rep->save();   
              
        }
        return response(['msg'=>'Update Successfully!']); 

    }

     


    public function delete(Request $r)
    {
        if($r->ajax())
        {
            //Univ::destroy($id);
            Category_Univ::destroy($r->id);
            return response(['id'=>$r->id]);
            
        }
        return response(['msg'=>'Delete Successfully!']);
    }



}
