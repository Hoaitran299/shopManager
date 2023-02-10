@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Sản phẩm')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@stop

@section('content')
    @php
        $TitlePage = 'Danh sách sản phẩm';
        $redirect = "/products";
        $childMenu =  'Thêm mới sản phẩm';
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
                <form action="{{ route('products.store') }}" method="POST" name="productForm" id="productForm"
                    class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('ProductName') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_name' name='product_name' type="text" class="form-control"
                                        value="{{ old('product_name') }}" placeholder="Nhập tên sản phẩm">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Price') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_price' name='product_price' type="text" class="form-control"
                                        value="{{ old('product_price') }}">
                                    @if ($errors->has('product_price'))
                                        <span class="text-danger">{{ $errors->first('product_price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Description') }}</label>
                                <div class="col-sm-9">
                                    <textarea id='description' name='description' type="text" class="form-control" rows="6"> {{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Active') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::select('is_sales', [0 => 'Ngưng bán', 1 => 'Đang bán', 2 => 'Hết hàng'], old('is_sales'), [
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
                                    <img style="width: 100%;height: 100%%;" id="preview" name="preview"
                                        src="{{ asset('img/products/default.jpg') }}" alt="your image" />
                                    @if ($errors->has('product_image'))
                                        <span class="text-danger"
                                            id="image-err">{{ $errors->first('product_image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <button id="removeImg" name="removeImg" type="button" class="btn btn-danger col-sm-3"
                                    style="display: none">Xóa
                                    ảnh</button>
                                <div class="file-upload col-sm-9">
                                    <div class="file-select">
                                        <div class="file-select-button " id="fileName">Choose File</div>
                                        <div class="file-select-name" id="noFile">No file chosen...</div>
                                        <input type="file" name="product_image" id="product_image"
                                            {{ old('description') }}>
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
            $('#removeImg').css('display', 'none');
        });
        $(document).ready(function() {
            $('#product_image').bind('change', function(e) {
                e.preventDefault();
                var fileImg = $('#product_image').prop('files')[0];
                if (/^\s*$/.test(fileImg)) {
                    $(".file-upload").removeClass('active');
                    $("#noFile").text("No file chosen...");
                } else {
                    console.log(fileImg);
                    $(".file-upload").addClass('active');
                    $("#noFile").text(fileImg['name']);
                    $('#removeImg').css('display', 'block');
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
                $("#preview").attr("src", defaultImage);
                $("#product_image").val("");
                $('.file-msg').text('Hoặc kéo thả ảnh vào đây');
                $('.fake-btn').text('Chọn ảnh');
                $("#product_image-err").empty();
            });
        });
    </script>
@stop
