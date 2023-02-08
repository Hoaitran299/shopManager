<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Http\Requests\CustomerRequest;
use App\Imports\CustomersImport;
use App\Models\MstCustomer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            $input = $request->all();
            $data = [
                'customer_name' => $input['name'],
                'email' => $input['email'],
                'tel_num' => $input['tel_num'],
                'address' => $input['address'],
                'is_active' => $input['is_active'] === "on" ? 1: 0,
            ];
            MstCustomer::create($data);
            return response()->json(['status' => 'success'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  \App\Models\MstCustomer  $mstCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        try {
            $id = $request->id;
            $input = $request->all();

            $data = [
                'name' => $input['name'],
                'email' => $input['email'],
                'address' => $input['address'],
                'tel_num' => $input['tel_num'],
                'is_active' => $input['is_active'] === "on" ? 1: 0,
            ];
            MstCustomer::where('id', $id)->update($data);

            return response()->json(['status' => 'success'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error'], 400);
        }
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
            $customer = MstCustomer::where('customer_id',$id)->first();
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
        Excel::import(new CustomersImport, 'customers.xlsx');
        
        return redirect('/')->with('success', 'All good!');
    }

    /**
     * Export customer list
     *
     */
    public function export(Request $request)
    {
        // $input = [];
        // if (request()->ajax()) {
        //     $input = $request->all();
        // }
        return Excel::download(new CustomersExport(), 'customers.xlsx');
    }
}
