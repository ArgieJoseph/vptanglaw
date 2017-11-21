<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Category;
use App\User;
use App\TUniversity;
use DB;
use Auth;


class AdminCampusController extends Controller
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
         $univs = DB::table('universities')
            ->join('categories', 'universities.c_id', '=', 'categories.id')
            ->select('universities.id AS id','universities.code','categories.name AS type' ,'universities.name','universities.address')
            ->paginate(5);

         $categorys= Category::pluck('name','id');
      
        if ($request->ajax()) {
           
            return view('tables.admin_campus_table', compact('univs'));
        }
 
        return view('pages.admin_campus',compact('univs','categorys'),array('user'=> Auth::user()));

    }

    public function create(Request $request)
    {

        if ($request->ajax())
        {
            $univ = new University();
           
            $univ['code'] = $request->code;
            $univ['c_id'] = $request->category_id;
            $univ['address'] = $request->address;
            $univ['name'] = $request->name;
            
            $univ->save();
               

            return response(['msg'=>'Inserted Successfully!']);
        }
        
    }


      public function get_data_search(Request $r)
    {
       if($r->ajax())
       {

        $univs=$this->data($r['search']);

        if(!(empty($r['search'])))
        {
            $search=$r['search'];
            $view=view('tables.admin_campus_table',compact('univs','search'))->render();
            return response($view);
        }
        else
        {
           $univs = DB::table('universities')
            ->join('categories', 'universities.c_id', '=', 'categories.id')
            ->select('universities.id AS id','universities.code','categories.name AS type' ,'universities.name','universities.address')
            ->paginate(5);
             $view=view('tables.admin_campus_table',compact('univs'))->render();

            return response($view);

       }

         } 
        
    }

      public function data($search)
    {

      return $univs = DB::table('universities')
            ->join('categories', 'universities.c_id', '=', 'categories.id')
            ->select('universities.id AS id' ,'universities.code','categories.name AS type' ,'universities.name','universities.address')
            ->where('categories.name','LIKE','%'.$search.'%')
            ->orWhere('universities.code','LIKE','%'.$search.'%')
            ->orWhere('universities.name','LIKE','%'.$search.'%')
            ->orWhere('universities.address','LIKE','%'.$search.'%')
            ->paginate(5);

    }



    public function edit(Request $r)
    {
        if($r->ajax())
        {
           $univ = University::find($r->id);


           return $data=
                  ['id' => $r->id ,  
                   'category_id' => $univ->c_id,
                   'code' => $univ->code,
                   'address'=>$univ->address,
                   'name' => $univ->name
                  ];
        }
    }

    public function update(Request $r)
    {
          if ($r->ajax())
        {
              $univ = University::find($r['id']);
              $univ['code'] = $r['code'];
              $univ['c_id']= $r['category_id'];
              $univ['address'] = $r['address'];
              $univ['name'] = $r['name'];
              $univ->save();

              return response(['msg'=>'Update Successfully!']);
        }
        
        
    }

        public function delete(Request $r)
        {
            if($r->ajax())
            {

                     University::destroy($r->id); 
                return response(['id'=>$r->id]);
                
            }
            return response(['msg'=>'Delete Successfully!']);
        }



}

