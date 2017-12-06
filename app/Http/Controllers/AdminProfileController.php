<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;

class AdminProfileController extends Controller
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
      /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function profiles(){
            foreach ($this->guard()->user()->role as $role) {

        if($role->name == 'Admin')
        {
            //return redirect('admin/home');
            return view('admin.profile.adminprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'Registrar')
        {
            return view('admin.profile.registrarprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'IPO')
        {
            return view('admin.profile.ipoprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'Director')
        {
            return view('admin.profile.directorprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'Vice President')
        {
            return view('admin.profile.vpprofile',array('user' => Auth::user()));
        }
         # code...

        }
       
        
    }

    public function updateavatar(Request $request){

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename= time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save('uploads/avatars/'. $filename);


            $user =Auth::user();
            $user->avatar = $filename;
            $user->update();
        }

       foreach ($this->guard()->user()->role as $role) {

        if($role->name == 'Admin')
        {
            //return redirect('admin/home');
            return view('admin.profile.adminprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'Registrar')
        {
            return view('admin.profile.registrarprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'IPO')
        {
            return view('admin.profile.ipoprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'Director')
        {
            return view('admin.profile.directorprofile',array('user' => Auth::user()));
        }
         elseif($role->name == 'Vice President')
        {
            return view('admin.profile.vpprofile',array('user' => Auth::user()));
        }
         # code...

        }
    }
}