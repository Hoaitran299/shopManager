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
                <form name="productForm" id="productForm" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $action }}" id="action">
                            <input type="hidden" value="{{ $product ? $product->product_id : '' }}" id="productID">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('ProductName') }}</label>
                                <div class="col-sm-9">
                                    <input id='name' name='name' type="text" class="form-control"
                                        value="{{ $product ? $product->product_name : '' }}"
                                        placeholder="Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Price') }}</label>
                                <div class="col-sm-9">
                                    <input id='price' name='price' type="text" class="form-control"
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
                                    {!! Form::select('isSales', [0 => 'Ngưng bán', 1 => 'Đang bán'], $product ? $product->is_sales : null, [
                                        'placeholder' => 'Chọn trạng thái...',
                                        'class' => 'form-control',
                                        'product_id' => 'isSales',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Hình ảnh</label>
                                <img style="margin-left: 10px;width: 80%;height: 200px;" id="preview" name="preview"
                                    src="{{ ($product && $product->product_image)? asset("'.$product->product_image.'"): asset('img/default.jpg') }}" alt="your image" />
                            </div>
                            <div class="form-group row">
                                <button id="removeImg" name="removeImg" type="button" class="btn btn-danger col-sm-2">Xóa ảnh</button>
                                <div class="file-upload col-sm-10">
                                    <div class="file-select">
                                        <div class="file-select-button " id="fileName">Choose File</div>
                                        <div class="file-select-name" id="noFile">No file chosen...</div>
                                        <input type="file" name="chooseFile" id="chooseFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7"></div>
                            <div class="col-sm-5 text-right">
                                <a href="{{ route('products') }}" id="btnCancel" name="btnCancel" class="btn btn-secondary">
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

        // // Reset PopupEditAddproduct
        function initProductForm() {
            $("#name").val('');
            $("#description").val('');
            $("#price").val('');
            $("#is_sales").val(1);
            $("#chooseFile").empty();
        };

        // clear error message
        function clearMessages() {
            $("#name-error").val('');
            $("#description-error").val('');
            $("#price-error").val('');
            $("#is_sales-error").val('');
            $("#chooseFile-error").val('');
            validator.resetForm();
        };

        //# Xử lý ADD-EDIT PRODUCT POPUP 
        // validate signup form on keyup and submit
        var validator = $("#productForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
                price: {
                    required: true,
                    digits: true,
                    min: 0,
                },
                chooseFile: {
                    extension: "jpg|jpeg|png",
                    max: 2048,
                    max_with: 1024,
                }
            },
            messages: {
                name: {
                    required: "{{ __('product_name.required') }}",
                    minlength: "{{ __('product_name.min') }}",
                },
                price: {
                    required: "{{ __('product_price.required') }}",
                    min: "{{ __('product_price.min') }}",
                    digits: "{{ __('product_price.digits') }}",
                },
                chooseFile: {
                    extension: "{{ __('product_image.extension') }}",
                    max: "{{ __('product_image.max') }}",
                    max_with: "{{ __('product_image.max_with') }}",
                }
            },
            submitHandler: function(form, e) {
                e.preventDefault();
                var formData = new FormData(form);
                console.log(formData);
                var action = $('#action').val();

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
                    });
                } else {
                    var productID = $('#productID').val();
                    console.log('edit user');
                    $.ajax({
                        url: '/products/update/' + productID,
                        type: "POST",
                        data: formData,
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
                    });
                }
            },
        });

        $('#chooseFile').bind('change', function() {
            var filename = $("#chooseFile").val();
            if (/^\s*$/.test(filename)) {
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen...");
            } else {
                $(".file-upload").addClass('active');
                $("#noFile").text(filename.replace("C:\\fakepath\\", ""));
                var fname =  document.getElementById("noFile").innerText;
                console.log(fname);
                if(fname){
                    const reader = new FileReader();
                    reader.addEventListener("load", () => {
                        $("#preview").attr("src", event.target.result);
                    });
                    reader.readAsDataURL(fname);
                }
            }
        });
    </script>
@stop
