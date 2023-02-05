<?php
/**
 * Quản lý Users
 *
 * @package Shop manager
 * @subpackage Controllers
 * @copyright Copyright (c) 2016 CriverCrane! Corporation. All Rights Reserved.
 * @author Tran Hoai<tran.hoai@rivercrane.vn>  
 */

namespace App\Http\Controllers;

use App\Models\MstUsers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

/**
 * Users Controller
 *
 * @copyright Copyright (c) 2016 CriverCrane! Corporation. All Rights Reserved.
 * @author Tran Hoai<tran.hoai@rivercrane.vn>  
 */

class MstUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //    $users = MstUsers::orderBy('id','desc')->paginate(10);
    //    return view('users.users',compact('users'));
        if ($request->ajax()) 
        {
            $data = User::get();

            return Datatables::of($data)->make(true);
        }
        return view('users.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MstUsers  $mstUsers
     * @return \Illuminate\Http\Response
     */
    public function show(MstUsers $mstUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MstUsers  $mstUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(MstUsers $mstUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstUsers  $mstUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MstUsers $mstUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstUsers  $mstUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstUsers $mstUsers)
    {
        //
    }

    /**
     * Lock User
     *
     * @param  \App\Models\MstUsers  $mstUsers
     * @return \Illuminate\Http\Response
     */
    public function lock(MstUsers $mstUsers)
    {
        //
    }
}
