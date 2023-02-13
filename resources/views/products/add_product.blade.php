@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Thêm mới sản phẩm')

@section('styles')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@stop

@section('content')
    @php
        $TitlePage = 'Danh sách sản phẩm';
        $redirect = '/products';
        $childMenu = 'Thêm mới sản phẩm';
    @endphp
    @include('layouts.header')
    <div class="container pr-0 pl-0">
        <div class="card" style="margin-top:10px">
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <div class="card-body">
                <form name="productForm" id="productForm" method="POST" class="form-horizontal"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('ProductName') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_name' name='product_name' type="text" class="form-control"
                                        placeholder="Nhập tên sản phẩm">
                                    <span class="text-danger msg-error" id="product_name-error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Price') }}</label>
                                <div class="col-sm-9">
                                    <input id='product_price' name='product_price' type="text" class="form-control" placeholder="Nhập giá sản phẩm">
                                    <span class="text-danger msg-error" id="product_price-error"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Description') }}</label>
                                <div class="col-sm-9">
                                    <textarea id='description' name='description' type="text" class="form-control" rows="6" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <span class="text-danger msg-error" id="description-error"></span>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ trans('Active') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::select('is_sales', [1 => 'Đang bán', 2 => 'Ngưng bán', 3 => 'Hết hàng'], 1, [
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
                                    <span class="text-danger msg-error" id="product_image-error"></span>
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
                                        <input type="file" name="product_image" id="product_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7"></div>
                            <div class="col-sm-5 text-right">
                                <button id="btnCancel" name="btnCancel" class="btn btn-secondary">
                                    Hủy</button>
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
            initProductForm();
            // Reset PopupEditAddproduct
            function initProductForm() {
                $("#product_name").val('');
                $("#description").val('');
                $("#product_price").val('');
                $("#is_sales").prop('selectIndex', 1);
                $("#product_image").empty();
            };

            // clear error message
            function clearMessages() {
                $("#msg-error").val('');
                $("#product_name-error").val('');
                $("#description-error").val('');
                $("#product_price-error").val('');
                $("#product_image-error").val('');
            };

            $('#product_image').change(function(e) {
                $("#product_image-error").val('');
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



            $('#productForm').submit(function(e) {
                e.preventDefault();
                clearMessages();
                var form = $('#productForm')[0];
                var formData = new FormData(this);
                formData.append('product_image', $('#product_image')[0].files[0]);

                $.ajax({
                    url: "{{ route('products.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response['status'] === 'success') {
                            $("#closePopup").trigger("click");
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Add success') }}",
                                'success');
                        }
                    },
                    error: function(response) {
                        console.log(response.responseJSON.errors);
                        clearMessages();
                        removeMsgEdit();
                        if (response.responseJSON.errors) {
                            $.each(response.responseJSON.errors, function(key, value) {
                                $("#" + key + '-error').html(value[0]);
                            });
                        } else {
                            $(".print-error-msg").css('display', 'block');
                            $(".print-error-msg").find("ul").append('<li>' + err.responseJSON.message + '</li>');
                        }
                    }
                });
            });

            function removeMsgEdit() {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'none');
            }

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
