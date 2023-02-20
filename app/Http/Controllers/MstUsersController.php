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

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\MstUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
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
        App::currentLocale();
        return view('users.users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        try {
            $input = $request->all();
            $is_active = $input['is_active'] === "true" ? 1 : 0;
            $data = [
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'group_role' => $input['group_role'],
                'is_active' => $is_active,
            ];
            MstUsers::create($data);
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error',"message"=> $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditUserRequest  $request
     * @param  int  $id      used to update the user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        try {
            $id = $request->id;
            $input = $request->all();
            $is_active = $input['is_active'] === "true" ? 1 : 0;
            $data = [
                'name' => $input['name'],
                'group_role' => $input['group_role'],
                'is_active' => $is_active
            ];
            if (!empty($input['password'])) {
                $data['password'] = Hash::make($input['password']);
            }
            MstUsers::where('id', $id)->update($data);
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error',"message"=> $e->getMessage()], 400);
        }
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
            MstUsers::destroy($id);
            return response()->json(['status' => 'success', 'data' => []], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'data' => []], 400);
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
            } else {
                MstUsers::where('id', $id)->update(['is_active' => 1]);
            }
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error'], 400);
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
            return response()->json(['status' => 'success', 'data' => $user], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => __('User not found')], 200);
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
