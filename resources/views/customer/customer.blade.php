@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Customers')

@section('styles')
@stop

@section('content')
@php
    $TitlePage = "Danh sách khách hàng";
    $redirect = "#";
    $childMenu = "";
@endphp
    @include('layouts.header')
    <div class="container-fluid pr-0 pl-0">
        <div class="card">
            <div class="card-body">
                <form action="" id="searchForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('Fullname') }}</label>
                                <input id='txtName' name='txtName' type="text" class="form-control"
                                    placeholder="Nhập {{ trans('Fullname') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input id='txtEmail' name='txtEmail' type="text" class="form-control"
                                    placeholder="Nhập email">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('Active') }}</label>
                                {!! Form::select('checkActive', [0 => 'Tạm khóa', 1 => 'Đang hoạt động'], null, [
                                    'placeholder' => 'Chọn trạng thái...',
                                    'class' => 'form-control',
                                    'id' => 'checkActive',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('Address') }}</label>
                                <input id='txtAddress' name='txtAddress' type="text" class="form-control"
                                    placeholder="Nhập địa chỉ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-left">
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".popupCustomer"><i class="fa fa-user-plus fa-border"></i><span> {{ __('Add')}}</span></button>
                        </div>
                        <div class="col-sm-4 text-left">
                                <label class="btn btn-success">
                                    <i class="fa fa-upload"></i> &nbsp;Import
                                    <input class="d-none" name="import" id="import" type="file">
                                </label>
                                <button id="btnExport" name="btnExport" type="submit" class="btn btn-success" style="margin-bottom: 6px">
                                    <span><i class="fas fa-file-export"></i>Export</span>
                                </button>
                        </div>
                        <div class="col-sm-5 text-right">
                            <button id="btnSearch" name="btnSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-search fa-border"></i><span> {{ __('Search')}}</span></button>
                            <button id="btnDelSearch" name="btnDelSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-border">X</i><span> {{ __('DeleteSearch')}}</span></button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row" style="margin:0.25rem">
                    <div class="card">
                        <div class="table-responsive" style="margin-top:0.25rem">
                            <table class="table table-hover customerList" id="customerList" name="customerList">
                                <thead>
                                    <tr class="bg-primary">
                                        <th style="width: 10px">#</th>
                                        <th>{{ trans('Fullname') }}</th>
                                        <th>Email</th>
                                        <th>{{ trans('Address') }}</th>
                                        <th style="width: 80px;">{{ trans('Phone') }}</th>
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
        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="modal fade popupCustomer" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                @include('customer.popupAddCustomer')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="//cdn.datatables.net/rowreorder/1.3.2/js/dataTables.rowReorder.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var dataTemp = null;
        $(document).ready(function() {
            var $table = $('#customerList');
            var action = "add";
            $.fn.DataTable.ext.pager.numbers_length = 10;

            // Get data lên DataTable
            var customerTable = $('#customerList').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                autoWidth: false,
                pagingType: "full_numbers_no_ellipses",
                pageLength: 20,
                // rowReorder: {
                //     dataSrc: 'readingOrder',
                //     editor:  editor
                // },
                select: true,
                dom: "<'row'<'col-sm-4'i><'col-sm-8 text-center'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 text-center'p>>",
                ajax: {
                    url: "{{ route('customers.getData') }}",
                    data: function(d) {
                        d.name = $("#txtName").val() ?? '';
                        d.email = $("#txtEmail").val() ?? '';
                        d.address = $("#txtAddress").val() ?? '';
                        d.is_active = $("#checkActive").val() ?? '';
                    }
                },
                order: [
                    [0, 'desc']
                ],
                lengthChange: false,
                columns: [{
                        data: 'customer_id',
                        name: 'customer_id'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'tel_num',
                        name: 'tel_num'
                    },
                    {
                        data: null,
                        render: function(data) {
                            $id = data["customer_id"];
                            $btn = '<button type="button" id="editCustomer-' + $id + '" data-id="' +
                                $id +
                                '" class="btn btn-info editCustomer"><i class="fa fa-edit"></i></button>';
                            $btn = $btn + ' <button type="button" id="saveCustomer-' + $id +
                                '" data-id="' +
                                $id +
                                '" class="btn btn-info saveCustomer d-none"><i class="fa fa-save"></i></button>';
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
                    
                    if((rows === 0 && pages === 0)){
                        $('.dataTables_paginate ').css('display', 'none');
                        $('.dataTables_info ').css('display', 'none');
                    }
                    else if (pages === 1) {
                        $('.dataTables_paginate ').css('display', 'none');
                        $('.dataTables_info ').css('display', 'block');
                    } 
                    else {
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

            // validate signup form on keyup and submit
            var validator = $("#addCustomerForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    address: {
                        required: true,
                    },
                    tel_num: {
                        required: true,
                        digits: true,
                        max: 999999999999,
                        min: 7,
                    },
                },
                messages: {
                    name: {
                        required: "{{ __('CustomerRequired') }}",
                        minlength: "{{ __('CustomerMinlength') }}",
                    },
                    email: {
                        required: "{{ __('EmailRequired') }}",
                        email: "{{ __('EmailType') }}",
                    },
                    address: {
                        required: "{{ __('address.required') }}",
                    },
                    tel_num: {
                        required: "{{ __('tel_num.required') }}",
                        digits: "{{ __('tel_num.regex') }}",
                        max: "max",
                        min: "min"
                    },
                },
                submitHandler: function(form, e) {
                    e.preventDefault();

                    var formData = new FormData(form);
                    console.log('add custom');
                    $.ajax({
                        url: "/customers",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            console.log(result);
                            if (result['status'] === 'success') {
                                Swal.fire(
                                    "{{ __('Notification') }}",
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
                    customerTable.ajax.reload();
                }
            });
            // Xử lý xoá textbox search
            $('#btnDelSearch').on('click', function(e) {
                $('#checkActive').prop('selectedIndex', 0);
                $('#txtAddress').val('');
                $('#txtName').val('');
                $('#txtEmail').val('');
                customerTable.ajax.reload();
            });

            // Xử lý search dữ liệu cho customerList
            $('#btnSearch').on('click', function(e) {
                e.preventDefault();
                customerTable.ajax.reload();
            })

            // Get thông tin customer by ID
            function getCustomerByID(id) {
                var customer = null;
                $.ajax({
                    url: "/customers/info/" + id,
                    type: "GET",
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        customer = data.data;
                    },
                });
                return customer;
            }

            //# Xử lý ADD-EDIT USER POPUP 

            // Reset PopupEditAddUser
            function initCustomerForm() {
                $("#name").val('');
                $("#email").val('');
                $("#tel_num").val('');
                $("#address").val('');
                $("#is_active").prop('selectedIndex', 0);
            }

            // clear error message
            function clearMessages() {
                $("#name-error").val('');
                $("#email-error").val('');
                $("#tel_num-error").val('');
                $("#address").val('');
                validator.resetForm();
            };

            // Reset Form AddUser
            $('#btnAdd').on('click', function() {
                clearMessages();
                initCustomerForm();
            });

            var customerID = null;

            // Get user cho popupEditCustomer
            $('#customerList').on('click', '.editCustomer', function() {
                var id = $(this).data("id");
                var customer = getCustomerByID(id);
                console.log(customer);
                if (customer != null) {
                    customerID = customer.customer_id;
                    $(this).val("d-none");
                    // $save = '.saveCustomer-'+customerID;
                    // $('.editCustomer-'+customerID).addClass("d-none");
                    var $row = $(this).closest("tr").off("mousedown");
                    var $tds = $row.find("td").not(':first').not(':last');
                    var item = {};
                    $.each($tds, function(i, el) {
                        var txt = $(this).text();
                        var inputName = "";
                        var title = "";
                        if (i === 0) {
                            title = "name";
                            item.name = txt;
                        } else if (i === 1) {
                            title = "email";
                            item.email = txt;
                        } else if (i === 2) {
                            title = "address";
                            item.address = txt;
                        } else {
                            title = "tel_num";
                            item.tel_num = txt;
                        }
                        inputName = title+ "-"+ customerID;
                        $(this).html("").append("<input class='form-control' id=\"" + inputName +
                            "\" name=\"" + inputName + "\" type='text' value=\"" + txt +
                            "\">");
                    });
                    console.log(item);
                } else {
                    Swal.fire("{{ __('Notification') }}", "{{ __('User not found') }}", 'error');
                }
            });
            $("#customerList").on('mousedown', "input", function(e) {
                e.stopPropagation();
            });

            $("#customerList").on('mousedown', ".saveCustomer", function(e) {

                $('.saveCustomer').addClass("d-none");
                $('.editCustomer').removeClass("d-none");
                var $row = $(this).closest("tr");
                var $tds = $row.find("td").not(':first').not(':last');

                $.each($tds, function(i, el) {
                    var txt = $(this).find("input").val()
                    $(this).html(txt);
                });
            });

            // Xử lý sửa thông tin customers
            $('body').on('click', '#btnEditCustomer', function(e) {
                e.preventDefault();

                //clearMessages();
                var name = $("#name").val();
                var email = $("#email").val();
                var address = $("#address").val();
                var active = ($("#checkActive").val()) === "on" ? 1 : 0;

                $.ajax({
                    url: '/customers/update/' + customerID,
                    type: "POST",
                    data: {
                        id: customerID,
                        name: name,
                        email: email,
                        address: address,
                        is_active: active,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (result['status'] === 'success') {
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Edit success') }}", 'success');
                            $('#btnEditCustomer').attr('id', 'btnAddCustomer');
                            $("#closePopup").trigger("click");
                            customerTable.ajax.reload();
                        } else {
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Edit error') }}", 'error');

                        }
                    },
                    beforeSend: function() {
                        clearMessages();
                    },
                });
            });

            // Xử lý import customers
            $('#searchForm').on('change', '#import', function(e) {
                e.preventDefault();
                var file_data = $('#import').prop('files')[0];
                console.log(file_data);
                var formData = new FormData();
                formData.append('file', file_data);

                $.ajax({
                    //url: "{{ route('customers.import') }}",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data['status'] === "success") {
                            Swal.fire(
                                '{{ __('Notification') }}',
                                '{{ __('Import success') }}',
                                'success'
                            )
                        } else {
                            Swal.fire(
                                '{{ __('Notification') }}',
                                '{{ __('Import error') }}',
                                'error'
                            )
                        }

                    },
                });
                customerTable.ajax.reload();
            });

            // Xử lý export customers
            $('body').on('click', '#btnExport', function(e) {
                e.preventDefault();
                var name = $("#txtName").val();
                var email = $("#txtEmail").val();
                var address = $("#txtAddress").val();
                var active = "";
                if ($("#checkActive").val()) {
                    active = $("#checkActive").val() === "on" ? 1 : 0
                }
                var filter = {
                    name: name,
                    email: email,
                    address: address,
                    is_active: active,
                };

                var base_url = window.location.origin;
                var url = base_url + '/customers/export?' + $.param(filter);
                window.location = url;
                Swal.fire(
                    '{{ __('Notification') }}',
                    '{{ __('Export success') }}',
                    'success'
                )
            });

            // Reset addCustomerForm sau khi close popup
            $(document).on('click', '#closePopup', function() {
                $('#popupTitle').html("{{ __('TitleAddUser') }}")
                clearMessages();
                initCustomerForm();
            })
        });
    </script>
@stop
