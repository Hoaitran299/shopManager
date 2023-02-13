<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\MstProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        return view('products.add_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $strNum = "000000000";
            $input = $request->all();
            $firstN = strtoupper($request->product_name[0]);
            $product_id = $firstN. $strNum;
            $img = "";
            if ($request->product_image) {
                $filename = time(). '_' . $request->product_image->getClientOriginalName();
                $request->file('product_image')->move(public_path('img/products'), $filename);
                $img = $filename;
            }
            $data = [
                'product_id' =>$product_id,
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price'],
                'description' => $input['description'],
                'is_sales' => $input['is_sales'],
                'product_image' => $img
            ];
            
            $product = MstProduct::create($data);
            if($product->id){
                $product_id = $firstN.substr($strNum,0,-(strlen($product->id))).$product->id;
                $product->product_id = $product_id;
                $product->save();
            }
            $response = array(
                "status"=>"success",
                "message"=> trans('Add success'),
                "status_code" => 200
            );
        } catch (\Throwable $e) {
            $response = array(
                "status"=>"errors",
                "message"=> $e->getMessage(),
                "status_code" => 400
            );
        }
        return json_encode($response);
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
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = MstProduct::where('id',$id)->first();
        return view('products.edit_product',["product"=> $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $input = $request->all();
            $strNum = "000000000";
            $input = $request->all();
            $firstN = strtoupper($request->product_name[0]);
            $product_id = $firstN.substr($strNum,0,-(strlen($id))).$id;
            $img = MstProduct::where('id', $id)->pluck('product_image')->first();
            if ($request->product_image) {
                $filename = time(). '_' . $request->product_image->getClientOriginalName();
                $request->file('product_image')->move(public_path('img/products'), $filename);
                if($img!= "") {
                    File::delete('img/products/'.$img);
                }
                $img = $filename;
            } else if ($img != "" && $request->img === "default.jpg"){
                File::delete('img/products/'.$img);
                $img = "";
            }
            else {
                $img = "";
            }
            $data = [
                'product_id' => $product_id,
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price'],
                'description' => $input['description'],
                'is_sales' => $input['is_sales'],
                'product_image' => $img
            ];
            MstProduct::where('id', $id)->update($data);

            $response = array(
                "status"=>"success",
                "message"=> trans('Edit success'),
                "status_code" => 200
            );
        } catch (\Throwable $e) {
            $response = array(
                "status"=>"errors",
                "message"=> $e->getMessage(),
                "status_code" => 400
            );
        }
        return json_encode($response);
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
            //$id = $request->id;
            $product = MstProduct::where('id',$id)->first();
            return response()->json(['status' => 'success', 'data' => $product], 200);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => __('product_found')], 200);
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
