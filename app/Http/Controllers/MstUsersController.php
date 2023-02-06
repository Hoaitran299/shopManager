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
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function show($id)
    {

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
     * @param int $id used to delete the user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            MstUsers::where('id', $id)->delete();
            return response()->json(['status' => 'success', 'data' => [], 'message' => 'Xoá thành công!'], 200);
        } catch (\Throwable$th) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => 'Xảy ra lỗi khi xóa, vui lòng thử lại!'], 400);
        }
    }

    /**
     * Lock user or unlock user
     *
     * @param $id use for find specified user
     */
    public function lockOrUnlockUser($id)
    {
        try {
            $status = MstUsers::where('id', $id)->pluck('is_active')->first();
            if ($status === 1) {
                MstUsers::where('id', $id)->update(['is_active' => 0]);
                $message = "Lock user thành công";
            } else {
                MstUsers::where('id', $id)->update(['is_active' => 1]);
                $message = "Unlock user thành công";
            }
            return response()->json(['status' => 'success', 'data' => [], 'message' => $message], 200);
        } catch (ModelNotFoundException $e) {
            $message = "Unlock user không thành công"+" Error: "+$e->getMessage();
            if ($status === 1) {
                $message = "Lock user không thành công"+" Error: "+$e->getMessage();
            }
            return response()->json(['status' => 'error', 'data' => [], 'message' => $message], 400);
        }
    }

    /**
     * get user by user id
     *
     * @param $id use for find specified user
     * @return \Illuminate\Http\Response
     */
    public function getUserByID($id)
    {
        try {
            $user = MstUsers::find($id);
            return response()->json(['status' => 'success', 'data' => $user, 'message' => ''], 200);
        } catch (\Throwable$th) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => 'Không tìm thấy người dùng'], 200);
        }
    }

    /**
     * search user .
     *
     */
    public function getUsersData(Request $request)
    {
        if (request()->ajax()) {
            $input = $request->all();
            $querySearch = MstUsers::query();
            $data = $querySearch->where('is_delete', 0);
            if (!empty($input['name'])) {
                $data = $data->where('name', 'like', '%' . $input['name'] . '%');
            }
            if (!empty($input['email'])) {
                $data = $data->where('email', 'like', '%' . $input['email'] . '%');
            }
            if (!empty($input['role'])) {
                $data = $data->where('group_role', $input['role']);
            }
            if ($input['active'] != "") {
                $data = $data->where('is_active', (int) $input['active']);
            }
            $data = $data->orderBy('id', 'DESC')->get();
            return Datatables::of($data)->make(true);
        }
    }
}
