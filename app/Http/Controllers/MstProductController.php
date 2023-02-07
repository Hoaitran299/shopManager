<?php

namespace App\Http\Controllers;

use App\Models\MstProduct;
use Illuminate\Http\Request;

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
     * @param  \App\Models\MstProduct  $mstProduct
     * @return \Illuminate\Http\Response
     */
    public function show(MstProduct $mstProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MstProduct  $mstProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(MstProduct $mstProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MstProduct  $mstProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MstProduct $mstProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MstProduct  $mstProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(MstProduct $mstProduct)
    {
        //
    }
}
