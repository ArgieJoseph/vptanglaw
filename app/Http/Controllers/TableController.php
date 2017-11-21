<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Univ;
use App\Category;
use App\Category_Univ;
use App\User;
use DB;
use Auth;


class TableController extends Controller
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
       
     
    }


    public function index(Request $request)
    {
         $univs = DB::table('category_univs')
            ->join('univs', 'category_univs.univ_id', '=', 'univs.id')
            ->join('categorys', 'category_univs.category_id', '=', 'categorys.id')
            ->select('category_univs.id AS id','univs.id AS uid' ,'univs.code','categorys.name AS type' ,'univs.name','univs.address')
            ->paginate(5);
        $categorys=Category::pluck('name','id');

        if ($request->ajax()) {
            return view('tables.admin_campus_table', compact('univs'));
        }
           //return view('pages.admin_campus',compact('univs'));   
        return view('pages.admin_campus',compact('categorys','univs'),array('user'=> Auth::user()));
 //return view('pages.admin_campus',['categorys'=>Category::pluck('name','id')],array('user'=> Auth::user()));


    }

	public function create(Request $request)
    {

    	if ($request->ajax())
    	{
    		$univ = new Univ();
    		$univ['code'] = $request->code;
            $codes = $request->code;
    		$univ['address'] = $request->address;
    		$univ['name'] = $request->name;
    			if($univ->save())
    			{
                     $cat_univ = new Category_Univ();
                     $univ_id = DB::table('univs')->where('code',$codes)->value('id');
                     $cat_univ['category_id'] = $request->category_id;
                     $cat_univ['univ_id'] = $univ_id;
                     $cat_univ->save();

                     return response(['msg'=>'Inserted Successfully!']);
    			}


    	}
    }


    public function read()
    {
       

           return view('tables.admin_campus_table');   
            //return response (['msg'=>'View Successfully!']);
        
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
                                    '<td>'.$univ->id.'</td>'.
                                    '<td>'.$univ->uid.'</td>'.
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
        $univs=$this->data($r['search']);
        if(!(empty($r['search'])))
        {
            $search=$r['search'];
            $view=view('tables.admin_campus_table',compact('univs','search'))->render();
            return response($view);
        }
       }

          
        
    }



      public function data($search)
    {
      return $univs = DB::table('category_univs')
            ->join('univs', 'category_univs.univ_id', '=', 'univs.id')
            ->join('categorys', 'category_univs.category_id', '=', 'categorys.id')
            ->select('category_univs.id AS id','univs.id AS uid' ,'univs.code','categorys.name AS type' ,'univs.name','univs.address')
            ->where('categorys.name',$search)
            ->orWhere('univs.code',$search)
            ->orWhere('univs.name',$search)
            ->orWhere('univs.address',$search)
            ->paginate(5);

           //return view('tables.admin_campus_table',compact('univs'));   
            //return response (['msg'=>'View Successfully!']);
        
    }



    public function edit(Request $r)
    {
        if($r->ajax())
        {
           $univ = Category_Univ::find($r->id);

           return $data=
                  ['id' => $r->id ,  
                  'univ_id' => $univ->univ->id,  
                  'category_id' => $univ->category->id,
                    'code' => $univ->univ->code,
                    'address'=>$univ->univ->address,
                    'name' => $univ->univ->name
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
              $univ = Univ::find($r['univ_id']);
              $univ['code'] = $r['code'];
              $univ['address'] = $r['address'];
             $univ['name'] = $r['name'];
            if ($univ->save())
            {
                    $cat_univ = Category_Univ::find($r->id);
                    $cat_univ['id'] = $r['id'];
                    $cat_univ['category_id'] = $r['category_id'];
                    $cat_univ['univ_id'] = $r['univ_id'];
                     $cat_univ->save();
                       return response(['msg'=>'Inserted Successfully!']);
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
            Category_Univ::destroy($r->id);
            return response(['id'=>$r->id]);
            
        }
    }



}

