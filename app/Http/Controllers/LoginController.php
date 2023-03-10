<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\MstUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
        if (Auth::check()) {
            return redirect()->intended('products');
        }
        return view('auth.login');
    }

    /**
     * Login User
     *
     */
    public function loginUser(LoginRequest $request)
    {
        $data = $request->only('email', 'password','remember_token');
        $date = date_format(Carbon::now(), Config::get('config.FORMAT_DATE_TIME'));
        if (Auth::attempt($data, $request->remember_token)) {
            $request->session()->put('info', $request->input());
            MstUsers::where('email', $request->email)
                ->update(['last_login_at' => $date, 'last_login_ip' => $request->ip()]);
            return redirect()->intended('products');
        }
        return back()->withInput($request->only('email', 'remember_token'))->withErrors([
            'password' => trans('Incorrect password')
        ]);
    }

    /**
     * Logout
     *
     */
    public function logOut()
    {

        session()->forget('info');
        Auth::logout();

        return redirect()->route('login');
    }
}
