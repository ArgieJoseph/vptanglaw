<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;
use Illuminate\Support\Facades\Input;
class ExcelController extends Controller
{
    //
   /* public function Export(Request $request)
    {

    	if ($request->ajax())
    	{
    		$univ = new Univ();
    		$univ['code'] = $request->code;
            $codes = $request->code;
    		$univ['address'] = $request->address;
    		$univ['name'] = $request->name;
    		$univ->save();
		}
    	Excel::create('clients',function($excel){
    	$excel->sheet('clients',function($sheet){
    	$sheet->loadView('tables.admin_campus_table');

    	});

    	})->export('xlsx');
    }*/

     public function Export()
    {


    	Excel::create('clients',function($excel){
    	$excel->sheet('clients',function($sheet){
    			$sheet->loadView('tables.ipo_main_table');

    	});

    	})->export('xlsx');
	}

	public function upload()
	{
		return view('upload');
	}

    public function importFromExcel (Request $request) {

        if ($request->has('file')) {

            
        }
    }


	public function import()
	{
		$file = Input::file('file');
		$file_name = $file->getClientOriginalName();
		$file->move('files',$file_name);
		//$result = Excel::load('files/'.$file_name,function($reader)
        $result = Excel::selectSheetsByIndex(1)->load('files/'.$file_name,function($reader)
		{
			//$reader->all();
            $reader->ignoreEmpty();
		})->get();
         $result1 = Excel::selectSheetsByIndex(0)->load('files/'.$file_name,function($reader)
        {
            //$reader->all();
            $reader->ignoreEmpty();
        })->get();


          if(!empty($result) && $result->count()){
                foreach ($result as $key => $value) {
                    if(!($value->camps=='')){
                    $insert[] = ['campus' => $value->camps, 'category' => $value->category, 'program' => $value->program, 'status' => $value->status, 'action' => $value->action];
                }
                }
                if(!empty($insert)){
                    DB::table('items')->truncate();
                    DB::table('items')->insert($insert);

                //  dd('Insert Record successfully.');
                }
            }
             if(!empty($result1) && $result1->count()){
                foreach ($result1 as $key => $value) {
                    if(!($value->camps=='')){
                    $insert1[] = ['campus' => $value->camps, 'category' => $value->category, 'program' => $value->program, 'status' => $value->status, 'action' => $value->action];
                }
                }
                if(!empty($insert1)){
                   // DB::table('samples')->truncate();
                    DB::table('samples')->insert($insert1);

                //  dd('Insert Record successfully.');
                }
            }
        
		return view('client',['clients' => $result1]);
	}

}