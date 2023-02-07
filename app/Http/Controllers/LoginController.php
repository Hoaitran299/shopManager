<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\LoginRequest;
use App\Models\MstUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

     /**
      * Where to redirect users after login.
      *
      * @var string
      */
     protected $redirectTo = '/products';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Login User
     *
     */
    public function loginUser(LoginRequest $request){
        $data = $request->only('email','password');
        $date = date_format(Carbon::now(), Config::get('config.FORMAT_DATE_TIME'));
        if (Auth::attempt($data,$request->remember)) {
            $request->session()->put('info',$request->input());
            MstUsers::where('email', $request->email)
                    ->update(['last_login_at' => $date, 'last_login_ip' => $request->ip()]);
            return redirect()->intended('products');
        } 
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'password' => trans('Incorrect password')
        ]);
    }

    /**
     * Logout
     *
     */
    public function logOut() {

        session()->forget('info');
        Auth::logout();
    
        return redirect()->route('login');
    }
}