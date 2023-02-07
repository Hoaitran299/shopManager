<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\MstCustomer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MstCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
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
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        dd('aaaaaa');
        // try {
        //     $input = $request->all();
        //     $data = [
        //         'customer_name' => $input['name'],
        //         'email' => $input['email'],
        //         'tel_num' => $input['tel'],
        //         'address' => $input['address'],
        //         'is_active' => $input['is_active']
        //     ];
        //     MstCustomer::create($data);
        //     return response()->json(['status' => 'success'], 200);
        // } catch (ModelNotFoundException $e) {
        //     return response()->json(['status' => 'error'], 400);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MstCustomer  $mstCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(MstCustomer $mstCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MstCustomer  $mstCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(MstCustomer $mstCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstCustomer  $mstCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MstCustomer $mstCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstCustomer  $mstCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstCustomer $mstCustomer)
    {
        //
    }

    /**
     * get user by user id
     *
     * @param $id use for find specified user
     * @return \Illuminate\Http\Response
     */
    public function getCustomerByID($id)
    {
        try {
            $customer = MstCustomer::where('customer_id',$id)->get();
            return response()->json(['status' => 'success', 'data' => $customer], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => __('User not found')], 200);
        }
    }

    /**
     * search user .
     *
     */
    public function getCustomerData(Request $request)
    {
        if (request()->ajax()) {
            $input = $request->all();
            $data = MstCustomer::query();

            if (!empty($input['name'])) {
                $data = $data->where('customer_name', 'like', '%' . $input['name'] . '%');
            }
            if (!empty($input['email'])) {
                $data = $data->where('email', 'like', '%' . $input['email'] . '%');
            }
            if (!empty($input['address'])) {
                $data = $data->where('address', 'like', '%' . $input['address'] . '%');
            }
            if ($input['active'] != "") {
                $data = $data->where('is_active', (int) $input['active']);
            }
            $data = $data->orderBy('customer_id', 'DESC')->get();
            return DataTables::of($data)->make(true);
        }
    }

    /**
     * Import customer list
     *
     */
    public function import(Request $request)
    {
        
    }

    /**
     * Export customer list
     *
     */
    public function export(Request $request)
    {
        
    }
}
