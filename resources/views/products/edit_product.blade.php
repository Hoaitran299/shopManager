@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Sản phẩm')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@stop

@section('content')
    @php
        $TitlePage = 'Danh sách sản phẩm';
        $redirect = "/products";
        $childMenu = 'Chỉnh sửa sản phẩm';
    @endphp
    @include('layouts.header')
    <div class="container pr-0 pl-0">
        <div class="card" style="margin-top:10px">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    @php
                        Session::forget('error');
                    @endphp
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('products.update', ['id' => $product->product_id]) }}" method="POST" id="productForm"
                    name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $product->product_id }}" id="productID">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('ProductName') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_name' name='product_name' type="text" class="form-control"
                                        value="{{ $product ? $product->product_name : '' }}"
                                        placeholder="Nhập tên sản phẩm">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Price') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_price' name='product_price' type="text" class="form-control"
                                        value="{{ $product ? $product->product_price : '' }}">
                                    @if ($errors->has('product_price'))
                                        <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Description') }}</label>
                                <div class="col-sm-9">
                                    <textarea id='description' name='description' type="text" class="form-control" rows="6"> {{ $product ? $product->description : '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Active') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::select('is_sales', [0 => 'Ngưng bán', 1 => 'Đang bán', 2 => 'Hết hàng'], $product->is_sales, [
                                        'class' => 'form-control',
                                        'product_id' => 'is_sales',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label">Hình ảnh</label>
                                </div>
                                <div class="row">
                                    <img style="margin-left: 10px;width: 100%;height: 100%%;" id="preview" name="preview"
                                        src="{{ $product && $product->product_image ? asset($product->product_image) : asset('img/products/default.jpg') }}"
                                        alt="your image" />
                                    @if ($errors->has('product_image'))
                                        <span class="text-danger"
                                            id="image-err">{{ $errors->first('product_image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <button id="removeImg" name="removeImg" type="button" class="btn btn-danger col-sm-3">Xóa
                                    ảnh</button>
                                <div class="file-upload col-sm-9">
                                    <div class="file-select">
                                        <div class="file-select-button " id="fileName">Choose File</div>
                                        <div class="file-select-name" id="noFile"></div>
                                        <input type="file" name="product_image" id="product_image" class="form-control" value="{{$product->product_image}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7"></div>
                            <div class="col-sm-5 text-right">
                                <a href="{{ route('products') }}" id="btnCancel" name="btnCancel"
                                    class="btn btn-secondary">
                                    Hủy</a>
                                <button id="btnSave" name="btnSave" type="submit" class="btn btn-danger">
                                    Lưu</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            var defaultImage ="default.jpg";
            $('#product_image').change(function () {
                var fullPath = document.getElementById("preview").src;
                var filename = fullPath.replace(/^.*[\\\/]/, '');
                console.log(filename);
                var fileImg = $('#product_image').prop('files')[0];
                if (/^\s*$/.test(fileImg)) {
                    console.log('noneeee');
                    $(".file-upload").removeClass('active');
                    if(filename != "default.jpg") {
                        $("#noFile").text(filename)
                    } else {
                        $("#noFile").text("No file chosen...");
                    }
                    $('#removeImg').css('display', 'none');
                } else {
                    console.log('yesssss');
                    $(".file-upload").addClass('active');
                    $('#removeImg').css('display', 'block');
                    $("#noFile").text(fileImg['name']);
                    if (fileImg) {
                        const reader = new FileReader();
                        reader.addEventListener("load", () => {
                            $("#preview").attr("src", event.target.result);
                        }, false);
                        reader.readAsDataURL(fileImg);
                    }
                }
            });
             /**
            * Handle button remove image 
            */
            $('#removeImg').click(function() {
                $('#removeImg').hide();
                $("#preview").attr("src", "{{ asset('img/products/default.jpg') }}");
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen...");
                $("#product_image-err").empty();
            });
        });
    </script>
@stop
