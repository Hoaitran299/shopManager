<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\MstUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

     /**
      * Where to redirect users after login.
      *
      * @var string
      */
     protected $redirectTo = '/product';

     /**
     * Create a new controller instance.
     *
     * @param App\Models\MstUsers $user submitted by users
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

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
        $date = date_format(Carbon::now('Asia/Ho_Chi_Minh'), 'Y/m/d:H-i-s');
        if (Auth::attempt($data,$request->remember)) {
            $request->session()->put('users',$request->input());
            MstUsers::where('email', $request->email)
                    ->update(['last_login_at' => $date, 'last_login_ip' => $request->ip()]);
            return redirect()->intended('product');
        } 
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'password' => 'Password không chính xác.',
        ]);
    }

    /**
     * Logout
     *
     */
    public function logOut() {
        Session::flush();
        Auth::logout();
   
        return redirect()->route('login');
    }
}