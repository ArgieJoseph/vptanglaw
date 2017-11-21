<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/admin_schoolyear';
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');

    }


 protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);


     foreach ($this->guard()->user()->role as $role) {

        if($role->name == 'Admin')
        {
            //return redirect('admin/home');
            return redirect('/admin/home');
        }
         elseif($role->name == 'Registrar')
        {
            return redirect('/registrar');
        }
         elseif($role->name == 'IPO')
        {
            return redirect('/ipo');
        }
         elseif($role->name == 'Director')
        {
            return redirect('/director');
        }
         elseif($role->name == 'Vice President')
        {
            return redirect('/vp');
        }
         # code...
        }
}
      /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.login');
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

        protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');

        return['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>'1'];
    }
}
