@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Sản phẩm')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@stop

@section('content')
    @php
        if ($action === 'add') {
            $TitlePage = 'Thêm mới sản phẩm';
        } else {
            $TitlePage = 'Chỉnh sửa sản phẩm';
        }
    @endphp
    @include('layouts.header')
    <div class="container pr-0 pl-0">
        <div class="card" style="margin-top:10px">
            <div class="card-body">
                <form name="productForm" id="productForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $action }}" id="action">
                            <input type="hidden" value="{{ $product ? $product->product_id : '' }}" id="productID">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('ProductName') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_name' name='product_name' type="text" class="form-control"
                                        value="{{ $product ? $product->product_name : '' }}"
                                        placeholder="Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Price') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_price' name='product_price' type="text" class="form-control"
                                        value="{{ $product ? $product->product_price : '' }}">
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
                                    {!! Form::select('is_sales', [0 => 'Ngưng bán', 1 => 'Đang bán'], $product ? $product->is_sales : null, [
                                        'placeholder' => 'Chọn trạng thái...',
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
                                        src="{{ $product && $product->product_image ? asset("'.$product->product_image.'") : asset('img/default.jpg') }}"
                                        alt="your image" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <button id="removeImg" name="removeImg" type="button" class="btn btn-danger col-sm-2">Xóa
                                    ảnh</button>
                                <div class="file-upload col-sm-10">
                                    <div class="file-select">
                                        <div class="file-select-button " id="fileName">Choose File</div>
                                        <div class="file-select-name" id="noFile">No file chosen...</div>
                                        <input type="file" name="product_image" id="product_image">
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
    <script src="//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document).ready(function() {
            // Reset PopupEditAddproduct
            function initProductForm() {
                $("#product_name").val('');
                $("#description").val('');
                $("#product_price").val('');
                $("#is_sales").val(1);
                $("#product_image").empty();
            };

            // clear error message
            function clearMessages() {
                $("#product_name-error").val('');
                $("#description-error").val('');
                $("#product_price-error").val('');
                $("#is_sales-error").val('');
                $("#product_image-error").val('');
                validator.resetForm();
            };

            //# Xử lý ADD-EDIT PRODUCT POPUP 
            // validate signup form on keyup and submit
            var validator = $("#productForm").validate({
                rules: {
                    product_name: {
                        required: true,
                        minlength: 5
                    },
                    product_price: {
                        required: true,
                        digits: true,
                        min: 0,
                    },
                    product_image: {
                        extension: "jpg|jpeg|png",
                        filesize: 2,
                        maxsize: 1024,
                    }
                },
                messages: {
                    product_name: {
                        required: "{{ __('product_name.required') }}",
                        minlength: "{{ __('product_name.min') }}",
                    },
                    product_price: {
                        required: "{{ __('product_price.required') }}",
                        min: "{{ __('product_price.min') }}",
                        digits: "{{ __('product_price.digits') }}",
                    },
                    product_image: {
                        extension: "{{ __('product_image.extension') }}",
                        filesize: "{{ __('product_image.max') }}",
                        maxsize: "{{ __('product_image.maxsize') }}"
                    }
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    var formData = new FormData(form);
                    console.log(formData);
                    var action = $('#action').val();
                    console.log(action);
                    if (action === 'add') {
                        console.log('add product');
                        $.ajax({
                            url: "{{ route('products.store') }}",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(result) {
                                console.log(result);
                                if (result['status'] === 'success') {
                                    $("#closePopup").trigger("click");
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Add success') }}",
                                        'success');
                                } else {
                                    Swal.fire(
                                        "{{ __('Notification') }}",
                                        "{{ __('Add error') }}",
                                        'error');
                                }
                            },
                            error: function(result) {
                                Swal.fire(
                                    "{{ __('Notification') }}",
                                    "{{ __('Add error') }}",
                                    'error');
                            }
                        });
                    } else {
                        var productID = $('#productID').val();
                        console.log('edit product: ' + productID);
                        $.ajax({
                            url: '/products/update/' + productID,
                            type: "POST",
                            data: {

                            },
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                if (data['status'] === 'success') {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Edit success') }}", 'success');
                                } else {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Edit error') }}", 'error');
                                }
                            },
                            error: function(result) {
                                Swal.fire(
                                    "{{ __('Notification') }}",
                                    result['message'],
                                    'error');
                            }
                        });
                    }
                    return false;
                },
            });

            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param * 1000000)
            }, 'File size must be less than {0} MB');

            $.validator.addMethod('maxsize', function(value, element, param) {
                var fileImg = $('#chooseImage').prop('files')[0];
                const reader = new FileReader();
                reader.readAsDataURL(fileImg);
                var image = new Image();
                var imgWidth = 0;
                var imgHeight = 0;
                reader.addEventListener("load", () => {
                    image.src = event.target.result;
                    image.onload = function() {
                        imgHeight = image.height;
                        imgWidth = image.width;
                    }
                }, false);
                return this.optional(element) || (imgWidth <= param || imgHeight <= param)
            }, 'Size must be less than {0}');

            $('#chooseImage').bind('change', function() {
                var fileImg = $('#chooseImage').prop('files')[0];
                if (/^\s*$/.test(fileImg)) {
                    $(".file-upload").removeClass('active');
                    $("#noFile").text("No file chosen...");
                } else {
                    console.log(fileImg);
                    $(".file-upload").addClass('active');
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
        });
    </script>
@stop
