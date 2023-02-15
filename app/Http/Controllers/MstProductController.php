<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\MstProduct;
use App\Models\ProductGroup;
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
            $input = $request->all();

            // Xử lý productID
            $strNum = "000000000";
            $firstChar = strtoupper($request->product_name[0]);
            $index_group = ProductGroup::where('prex_group',$firstChar)->orderBy('index', 'DESC')->pluck('index')->first();
            $index = $index_group ? ($index_group + 1): 1;
            ProductGroup::create(['prex_group'=> $firstChar,'index'=> $index]);
            $product_id = $firstChar.substr($strNum,0,-(strlen($index))).$index;

            $image = "";
            if ($request->product_image) {
                $filename = time(). '_' . $request->product_image->getClientOriginalName();
                $request->file('product_image')->move(public_path('img/products'), $filename);
                $image = $filename;
            }
            $data = [
                'product_id' =>$product_id,
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price'],
                'description' => $input['description'],
                'is_sales' => $input['is_sales'],
                'product_image' => $image
            ];
            
            MstProduct::create($data);
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
            $oldChar = MstProduct::where('id', $id)->pluck('product_id')->first();
            $firstChar = strtoupper($request->product_name[0]);
            $product_id = "";

            // Kiểm tra tên sản phẩm thay đổi là nhóm cũ hay nhóm mới
            if($oldChar[0] === $firstChar){
                $product_id = $oldChar;
            } else{
                // Nếu nhóm mới, xoá nhóm cũ và thêm nhóm mới.
                $index_group = ProductGroup::where('prex_group',$firstChar)->orderBy('index', 'DESC')->pluck('index')->first();
                $index = $index_group ? ($index_group + 1): 1;
                ProductGroup::where('prex_group', strtoupper($oldChar[0]))->where('index', (int)(substr($oldChar,1)))->delete();
                ProductGroup::create(['prex_group'=> $firstChar,'index'=> $index]);
                $product_id = $firstChar.substr($strNum,0,-(strlen($index))).$index;
            }
            $image = MstProduct::where('id', $id)->pluck('product_image')->first();
            if ($request->product_image) {
                $filename = time(). '_' . $request->product_image->getClientOriginalName();
                $request->file('product_image')->move(public_path('img/products'), $filename);
                if($image!= "") {
                    File::delete('img/products/'.$image);
                }
                $image = $filename;
            } else if ($image != "" && $request->img === "default.jpg"){
                File::delete('img/products/'.$image);
                $image = "";
            }
            else if($image =="" && !$request->product_image){
                $image = "";
            }
            $data = [
                'product_id' => $product_id,
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price'],
                'description' => $input['description'],
                'is_sales' => $input['is_sales'],
                'product_image' => $image
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
            $image = MstProduct::where('id', $id)->pluck('product_image')->first();
            if($image){
                File::delete('img/products/'.$image);
            }     
            MstProduct::where('id', $id)->delete();

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
