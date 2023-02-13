<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Http\Requests\AddCustomerRequest;
use App\Http\Requests\CustomerImportRequest;
use App\Http\Requests\EditCustomerRequest;
use App\Imports\CustomersImport;
use App\Models\MstCustomer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
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
        return view('customer.customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCustomerRequest $request)
    {
        try {
            $input = $request->all();
            $data = [
                'customer_name' => $input['txtName'],
                'email' => $input['txtEmail'],
                'tel_num' => $input['txtTel_num'],
                'address' => $input['txtAddress'],
                'is_active' => $input['is_active'] === "on" ? 1: 0,
            ];
            MstCustomer::create($data);
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error',"message"=> $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditCustomerRequest  $request
     * @param  \App\Models\MstCustomer  $mstCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(EditCustomerRequest $request)
    {
        try {
    		if($request->action == 'edit')
    		{   
                $id = $request->customer_id;
                $input = $request->all();

                $data = [
                    'customer_name' => $input['customer_name'],
                    'email' => $input['email'],
                    'address' => $input['address'],
                    'tel_num' => $input['tel_num'],
                ];
                MstCustomer::where('customer_id', $id)->update($data);
                return response()->json(['status' => 'success'], 200);
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error',"message"=>$e->getMessage()], 400);
        }
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
        } catch (\Throwable $e) {
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
            if ($input['is_active'] != "") {
                $data = $data->where('is_active', (int) $input['is_active']);
            }
            $data = $data->orderBy('customer_id', 'DESC')->get();
            return DataTables::of($data)
            ->setRowId(function ($user) {
                return $user->customer_id;
            })
            ->make(true);
        }
    }

    /**
     * Import customer list
     *
     */
    public function import(CustomerImportRequest $request)
    {
        try {
            $import = Excel::import(new CustomersImport, request()->file('file'));
            return response()->json(['status' => 'success', 'message' => trans('Import success')], 200);
        } catch (ValidationException $e) {
             $failures = $e->failures();
             
             foreach ($failures as $failure) {
                 $row = $failure->row(); // row that went wrong
                 $column = $failure->attribute(); // either heading key (if using heading row concern) or column index
                 $messages = $failure->errors(); // Actual error messages from Laravel validator
                 Log::debug('Error row: ' . $row . ' \n| column error:'.$column.' \n| Message: ' . $messages[0]);
            }
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        } catch (NoTypeDetectedException $e) {
            return response()->json(['status' => 'error', 'errors' => trans('import.extension')], 400);
        }
    }

    /**
     * Export customer list
     *
     */
    public function export(Request $request)
    {
        $date = Carbon::now()->year."".Carbon::now()->month."".Carbon::now()->day."".Carbon::now()->hour."".Carbon::now()->minute."".Carbon::now()->second;
        
        $filename = 'customers_' .$date.'.xlsx';
        $data = null;
        $filter = $request->all();
        $data = MstCustomer::query();
        if (!empty($filter['name'])) {
            $data = $data->where('customer_name', 'like', '%' . $filter['name'] . '%');
        }
        if (!empty($filter['email'])) {
            $data = $data->where('email', 'like', '%' . $filter['email'] . '%');
        }
        if (!empty($filter['address'])) {
            $data = $data->where('address', 'like', '%' . $filter['address'] . '%');
        }
        if ($filter['is_active'] != "") {
            $data = $data->where('is_active', (int) $filter['is_active']);
        }
        $data = $data->select('customer_name','email','tel_num','address')->orderBy('customer_id', 'DESC')->get();
            //dd($data);
        return Excel::download(new CustomersExport($data),$filename);
    }
}
