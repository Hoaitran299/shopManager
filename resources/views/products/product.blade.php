@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Sản phẩm')

@section('styles')
@stop

@section('content')
    @php
        $TitlePage = 'Danh sách sản phẩm';
    @endphp
    @include('layouts.header')
    <div class="container-fluid pr-0 pl-0">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('ProductName') }}</label>
                                <input id='txtName' name='txtName' type="text" class="form-control"
                                    placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>{{ trans('Active') }}</label>
                                {!! Form::select('isSales', [0 => 'Ngưng bán', 1 => 'Đang bán'], null, [
                                    'placeholder' => 'Chọn trạng thái...',
                                    'class' => 'form-control',
                                    'id' => 'isSales',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>{{ trans('PriceFrom') }}</label>
                                <input id='txtPriceFrom' name='txtPriceFrom' type="text" class="form-control">
                            </div>
                        </div>
                        ~
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>{{ trans('PriceTo') }}</label>
                                <input id='txtPriceTo' name='txtPriceTo' type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-left">
                            <a href="{{ route('products.create') }}" id="btnAdd" name="btnAdd"
                                class="btn btn-primary"><i class="fa fa-user-plus fa-border"></i><span>
                                    {{ trans('Add') }}</span></a>
                        </div>
                        <div class="col-md-10 text-right">
                            <button id="btnSearch" name="btnSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-search fa-border"></i><span> {{ __('Search') }}</span></button>
                            <button id="btnDelSearch" name="btnDelSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-border">X</i><span> {{ __('DeleteSearch') }}</span></button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row" style="margin:0.25rem">
                    <div class="card">
                        <div class="table-responsive dt-responsive nowrap" style="margin-top:0.25rem;width: 100%;">
                            <table class="table table-hover productList " id="productList" name="productList">
                                <thead>
                                    <tr class="bg-primary">
                                        <th style="width: 10px; text-align: center"> # </th>
                                        <th>{{ trans('ProductName') }}</th>
                                        <th>{{ trans('Description') }}</th>
                                        <th>{{ trans('Price') }}</th>
                                        <th>{{ trans('Active') }}</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {

            $.fn.DataTable.ext.pager.numbers_length = 10;
            var productsTable = $('.productList').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                autoWidth: false,
                pagingType: "full_numbers_no_ellipses",
                pageLength: 20,
                dom: "<'row'<'col-sm-4'i><'col-sm-8 text-center'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 text-center'p>>",
                ajax: {
                    url: "{{ route('products.getData') }}",
                    data: function(d) {
                        d.name = $("#txtName").val() ?? '';
                        d.is_sales = $("#isSales").val() ?? '';
                        d.price_from = $("#txtPriceFrom").val() ?? '';
                        d.price_to = $("#txtPriceTo").val() ?? '';
                    }
                },
                order: [
                    [0, 'desc']
                ],
                lengthChange: false,
                columns: [{
                        data: 'product_id',
                        name: 'product_id'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'product_price',
                        name: 'product_price'
                    },
                    {
                        data: 'is_sales',
                        render: function(data) {
                            var str = "";
                            if (data === 1) {
                                str =
                                    "<span class='text-left text-success'>Đang bán</span>";
                            } else {
                                str = "<span class='text-left text-danger'>Ngưng bán</span>";
                            }
                            return str;
                        },
                    },
                    {
                        data: null,
                        render: function(data) {
                            $id = data["product_id"];
                            console.log($id);
                            $btn = '<a href="/products/' + $id + '/edit" id="popupEdit-' + $id +
                                '" data-id="' + $id +
                                '" class="btn btn-info popupEditProduct"><i class="fa fa-edit"></i></a>';
                            $btn = $btn + ' <button type="button" id="delD-' + $id +
                                '" name="delD-' + $id + '" data-id="' + $id +
                                '" class="btn btn-danger removeProduct" ><i class="fa fa-trash"></i></button>';
                            return $btn;
                        },
                        orderable: false,
                        serachable: false
                    },
                ],
                drawCallback: function() {
                    var row_page = 20;
                    var $api = this.api();
                    var pages = $api.page.info().pages;
                    var rows = $api.data().length;

                    if ((rows === 0 && pages === 0)) {
                        $('.dataTables_paginate ').css('display', 'none');
                        $('.dataTables_info ').css('display', 'none');
                    } else if (pages === 1) {
                        $('.dataTables_paginate ').css('display', 'none');
                        $('.dataTables_info ').css('display', 'block');
                    } else {
                        $('.dataTables_paginate ').css('display', 'block');
                        $('.dataTables_info ').css('display', 'block');
                    }
                },
                language: {
                    processing: "{{ __('processing') }}",
                    info: "{{ __('showPage') }}",
                    infoEmpty: "{{ __('infoEmpty') }}",
                    emptyTable: "{{ __('infoEmpty') }}",
                    paginate: {
                        first: "«",
                        previous: "‹",
                        next: "›",
                        last: "»"
                    },
                },
            });


            // Xử lý xoá textbox search
            $('#btnDelSearch').on('click', function(e) {
                $('#isSales').prop('selectedIndex', 0);
                $('#txtPriceFrom').prop('selectedIndex', 0);
                $('#txtName').val('');
                $('#txtPriceTo').val('');
                productsTable.ajax.reload();
            });

            // Xử lý search dữ liệu cho productList
            $('#btnSearch').on('click', function(e) {
                e.preventDefault();
                productsTable.ajax.reload();
            })

            // Get thông tin product by ID
            // function getProductByID(id) {
            //     var product = null;
            //     $.ajax({
            //         url: "/products/details/" + id,
            //         type: "GET",
            //         async: false,
            //         dataType: 'json',
            //         success: function(data) {
            //             product = data.data;
            //         },
            //     });
            //     return product;
            // }

            // // Xử lý xoá product 
            $(document).on('click', '.removeProduct', function(e) {
                var id = $(this).data("id");
                var product = getProductByID(id);
                var cfm = "{{ __('Confirm delete product') }}" + " " + product.product_name + " ?";
                e.preventDefault();
                Swal.fire({
                    title: "{{ __('Warning') }}",
                    text: cfm,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/products/" + id,
                            type: "delete",
                            async: false,
                            success: function(result) {
                                if (result['status'] === 'success') {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Delete success') }}", 'success');
                                    productsTable.ajax.reload();
                                } else {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Delete error') }}", 'error');
                                }
                            },
                        });
                        productsTable.ajax.reload();
                    }
                })
            });
        });
    </script>
@stop
