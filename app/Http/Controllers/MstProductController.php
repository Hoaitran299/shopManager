<?php

namespace App\Http\Controllers;

use App\Models\MstProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\Facades\DataTables;

class MstProductController extends Controller
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
    public function index()
    {
        return view('products.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.add_edit_product',["product"=>"","action"=>"add"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $data = [
                'product_name' => $input['name'],
                'product_price' => $input['price'],
                'description' => $input['description'],
                'is_sales' => $input['is_sales']
            ];
            MstProduct::create($data);
            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = MstProduct::where('product_id',$id)->first();
        return view('products.add_edit_product',["product"=> $product,"action"=>"edit"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $id = $request->id;
            $input = $request->all();

            $data = [
                'product_name' => $input['name'],
                'product_price' => $input['price'],
                'description' => $input['description'],
                'is_sales' => $input['is_sales']
            ];
            MstProduct::where('product_id', $id)->update($data);

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            MstProduct::where('product_id', $id)->delete();
            return response()->json(['status' => 'success', 'data' => []], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'data' => []], 400);
        }
    }

        /**
     * get product by product id
     *
     * @param $id use for find specified user
     * @return \Illuminate\Http\Response
     */
    public function getProductByID($id)
    {
        try {
            $product = MstProduct::where('product_id',$id)->first();
            return response()->json(['status' => 'success', 'data' => $product], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'data' => [], 'message' => __('User not found')], 200);
        }
    }

    /**
     * search user .
     *
     */
    public function getProductData(Request $request)
    {
        if (request()->ajax()) {
            $input = $request->all();
            $data = MstProduct::query();
            
            if (!empty($input['name'])) {
                $data = $data->where('product_name', 'like', '%' . $input['name'] . '%');
            }
            if(!empty($input['price_from']) && !empty($input['price_to'])) {
                $data = $data->whereBetween('product_price', [(int)$input['price_from'], (int)$input['price_to']]);
            } else if (!empty($input['price_from'])) {
                $data = $data->where('product_price', '>=', $input['price_from']);
            }
            else if (!empty($input['price_to'])) {
                $data = $data->where('product_price', '<=', $input['price_to']);
            }
            if ($input['is_sales'] != "") {
                $data = $data->where('is_sales', (int) $input['is_sales']);
            }
            $data = $data->orderBy('product_id', 'DESC')->get();
            return DataTables::of($data)->make(true);
        }
    } 
}
