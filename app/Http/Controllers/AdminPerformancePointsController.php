<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\role;
use App\User;
use App\Admin;
use App\role_admin;
use DB;
use Validator;

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
      /*
      $report_categories = AdminPerformancePoints::all();
    	$this->layout = View::make($this->layout)->with('rc_name',$report_categories);
      

      $report = DB::table('reports')
      */
    	$admin= DB::table('role_admins')
    		->join('roles','role_admins.role_id','=','roles.id')
    		->join('admins','role_admins.admin_id','=','admins.id')
    		->select('role_admins.role_id as role_id','admins.status as status','role_admins.id AS id','admins.fname AS fname','admins.mname AS mname','admins.lname AS lname','roles.name AS rname','admins.email AS email')
    		->paginate(5);
    	$roles=role::pluck('name','id');
    	

    	  if ($request->ajax()) {
            return view('tables.admin_user_table', compact('admin'));
        }
    return view('pages.admin_performance_points',compact('roles','admin'),array('user'=> Auth::user()));
    }




       /* public function validation($request)
    {
        return $this->validate($request, [
            'fname' => 'required|string|max:255',
            'mname' => 'string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|min:6',
        ]);
    }


    	public function create(Request $request)
    {
    	if($this->validation($request))
    	{
    		return response(['msg'=>'Inserted Successfully!']);
    	}

    	if ($request->ajax())
    	{
    		

    		$admin = new Admin();
    		$admin['fname'] = $request->fname;
    		$admin['mname'] = $request->mname;
    		$admin['lname'] = $request->lname;
    		$admin['email'] = $request->email;
    		$admin['password'] = bcrypt($request->password);
    		$admin['status'] = '1';
    		 		$e = $request->email;
    			if($admin->save())
    			{
                     $role_admin = new role_admin();
                     $admin_id = DB::table('admins')->where('email',$e)->value('id');
                     $role_admin['admin_id'] = $admin_id;
                     $role_admin['role_id'] = $request->role_id;
                     $role_admin->save();

                     return response(['msg'=>'Inserted Successfully!']);
    			}


    	}
    }*/



       public function myformPost(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'mname' => 'string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|min:6',
        ]);

        if ($validator->passes()) {

		if ($request->ajax())
    	{
    		

    		$admin = new Admin();
    		$admin['fname'] = $request->fname;
    		$admin['mname'] = $request->mname;
    		$admin['lname'] = $request->lname;
    		$admin['email'] = $request->email;
    		$admin['password'] = bcrypt($request->password);
    		$admin['status'] = '1';
    		 		$e = $request->email;
    			if($admin->save())
    			{
                     $role_admin = new role_admin();
                     $admin_id = DB::table('admins')->where('email',$e)->value('id');
                     $role_admin['admin_id'] = $admin_id;
                     $role_admin['role_id'] = $request->role_id;
                     $role_admin['status'] = '1';
                     $role_admin->save();

                  
    			}


    	}
return response()->json(['success'=>'Added new records.']);
        }

    	return response()->json(['error'=>$validator->errors()->all()]);
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


      public function editStatus(Request $r)
    {
          if($r->ajax())
          {
             $ra = role_admin::find($r->id);

              return $data=
                  [
                    'id' => $r->id, 
                    'status' => $ra->status,
                    'uid'=>$ra->admin->id
                  ];
            // $cat= Category_Univ::find($r->id)->category;
                    //return response(Category_Univ::find($r->id));
                  //return response($cat); 
          }
        return view('pages.admin_performance_points',compact('ra'));
    }


    public function updateStatus(Request $r)
    {
          

          if ($r->ajax())
        {
              


              $a = Admin::find($r['uid']);
              if($r['status'] == '1'){
              $a['status'] = '0';
           	}
           	else{
           		
           		$a['status'] = '1';
           	 	
           	}

           if ($a->save())
        {
              


              $ra = role_admin::find($r['id']);
              if($r['status'] == '1'){
              $ra['status'] = '0';
              $ra->save();
            }
            else{
              
              $ra['status'] = '1';
              $ra->save();
            }

                /* $univ = Category_Univ::find($r->id);

                 $data =
                  ['univ_id' => $r['univ_id'],  
                  'category_id' => $r['category_id'],
                    'code' => $r['code'],
                    'address'=>$r['address'],
                    'name' =>  $r['name']
                  ];

                $univ->save();*/

                  //$cat_univ['category_id'] = $r['category_id'];
                   // $cat_univ['univ_id'] = $r['univ_id'];

           // return $data;
       //  $cat_univ->save();
      // return response(['msg'=>'Update Successfully!']);
           return response(['msg'=>'Updated Successfully!']);     
        } 
        }
         
    }

    public function edit(Request $r)
    {
        if($r->ajax())
        {
           $ra = role_admin::find($r->id);

           return $data=
                  ['id' => $ra->id ,  
                  'admin_id' => $ra->admin_id,  
                  'role_id' => $ra->role_id,
                    'fname' => $ra->admin->fname,
                    'mname'=>$ra->admin->mname,
                    'lname' => $ra->admin->lname,
                    'email' => $ra->admin->email,
                    'status' => $ra->status,
                    'inputPassword' => $ra->admin->password
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
            
                /* $univ = Category_Univ::find($r->id);

                 $data =
                  ['univ_id' => $r['univ_id'],  
                  'category_id' => $r['category_id'],
                    'code' => $r['code'],
                    'address'=>$r['address'],
                    'name' =>  $r['name']
                  ];

                $univ->save();*/

                  //$cat_univ['category_id'] = $r['category_id'];
                   // $cat_univ['univ_id'] = $r['univ_id'];
              $admin = Admin::find($r['admin_id']);
              $admin['fname'] = $r['fname'];
              $admin['mname'] = $r['mname'];
              $admin['lname'] = $r['lname'];
            
  
                       return response(['msg'=>'Update Successfully!']);
            
            
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
            Category_Univ::destroy($r->id);
            return response(['id'=>$r->id]);
            
        }
        return response(['msg'=>'Delete Successfully!']);
    }



}
