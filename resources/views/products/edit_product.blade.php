@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Sản phẩm')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@stop

@section('content')
    @php
        $TitlePage = 'Danh sách sản phẩm';
        $redirect = '/products';
        $childMenu = 'Chỉnh sửa sản phẩm';
    @endphp
    @include('layouts.header')
    <div class="container pr-0 pl-0">
        <div class="card" style="margin-top:10px">
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <div class="card-body">
                <form method="POST" id="productForm"
                    name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="hidden" value="{{ $product->id }}" id="id">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('ProductName') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_name' name='product_name' type="text" class="form-control"
                                        value="{{ $product ? $product->product_name : '' }}"
                                        placeholder="Nhập tên sản phẩm">
                                    <span class="text-danger msg-error" id="product_name-error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Price') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_price' name='product_price' type="text" class="form-control"
                                        value="{{ $product ? $product->product_price : '' }}"
                                        placeholder="Nhập giá sản phẩm">
                                    <span class="text-danger msg-error" id="product_price-error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Description') }}</label>
                                <div class="col-sm-9">
                                    <textarea id='description' name='description' type="text" class="form-control" rows="6"
                                        placeholder="Mô tả sản phẩm"> {{ $product ? $product->description : '' }}</textarea>
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
                                        src="{{ $product->product_image ? asset('img/products/' . $product->product_image) : asset('img/products/default.jpg') }}"
                                        alt="your image" />
                                    <span class="text-danger msg-error" id="product_image-error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button id="removeImg" name="removeImg" type="button" class="btn btn-danger col-sm-3" style="display: none">Xóa
                                    ảnh</button>
                                <div class="file-upload col-sm-9">
                                    <div class="file-select">
                                        <div class="file-select-button " id="fileName">Choose File</div>
                                        <div class="file-select-name" id="noFile">
                                            {{ $product->product_image ?? 'No file chosen...' }}</div>
                                        <input type="file" name="product_image" id="product_image" class="form-control"
                                            value="{{ asset('img/products/' .$product->product_image) }}">
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var product = getProductByID($("#id").val());
            product['product_image'] ? $('#removeImg').css('display', 'block') : $('#removeImg').css('display', 'none')
            var defaultImage = "default.jpg";
            
            $('#product_image').change(function(e) {
                $("#product_image-error").empty();
                e.preventDefault();
                var fileImg = $('#product_image').prop('files')[0];
                if (/^\s*$/.test(fileImg)) {
                    $(".file-upload").removeClass('active');
                    $("#noFile").text("No file chosen...");
                    $('#removeImg').css('display', 'none');
                } else {
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

             // clear error message
             function clearMessages() {
                $("#product_name-error").empty();
                $("#description-error").empty();
                $("#product_price-error").empty();
                $("#product_image-error").empty();
            };

            $('#productForm').submit(function(e) {
                e.preventDefault();
                clearMessages();
                var id = $("#id").val();
                var form = $('#productForm')[0];
                var formData = new FormData(this);
                formData.append('product_image', $('#product_image')[0].files[0]);

                $.ajax({
                    url: "/products/update/" + id,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response['status'] === 'success') {
                            $("#closePopup").trigger("click");
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Edit success') }}",
                                'success');
                        }
                    },
                    error: function(err) {
                        clearMessages();
                        removeMsgEdit();
                        if (err.responseJSON.errors) {
                            $.each(err.responseJSON.errors, function(key, value) {
                                $("#" + key + '-error').html(value[0]);
                            });
                        } else {
                            $(".print-error-msg").css('display', 'block');
                            $(".print-error-msg").find("ul").append('<li>' + err.responseJSON
                                .message + '</li>');
                        }
                    }
                });
            });

            function removeMsgEdit() {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'none');
            }

            // Get thông tin user by ID
            function getProductByID(id) {
                var product = null;
                $.ajax({
                    url: "/products/detail/" + id,
                    type: "GET",
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        product = data.data;
                    },
                });
                return product;
            }
            /**
             * Handle button remove image 
             */
            $('#removeImg').click(function() {
                $('#removeImg').hide();
                $("#preview").attr("src", "{{ asset('img/products/default.jpg') }}");
                $(".file-upload").removeClass('active');
                $("#noFile").text("No file chosen...");
                $("#product_image").val('');
                $("#product_image-error").empty();
            });
        });
    </script>
@stop
