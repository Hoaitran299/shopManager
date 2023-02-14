@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Customers')

@section('styles')
    {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
@stop

@section('content')
    @php
        $TitlePage = 'Danh sách khách hàng';
        $redirect = '#';
        $childMenu = '';
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
                                <input id='filterName' name='filterName' type="text" class="form-control"
                                    placeholder="Nhập {{ trans('Fullname') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input id='filterEmail' name='filterEmail' type="text" class="form-control"
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
                                <input id='filterAddress' name='filterAddress' type="text" class="form-control"
                                    placeholder="Nhập địa chỉ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-left">
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".popupCustomer"><i class="fa fa-user-plus fa-border"></i><span>
                                    {{ __('Add') }}</span></button>
                        </div>
                        <div class="col-sm-4 text-left">
                            <label class="btn btn-success">
                                <i class="fa fa-upload"></i> &nbsp;Import
                                <input class="d-none" name="import" id="import" type="file">
                            </label>
                            <button id="btnExport" name="btnExport" type="submit" class="btn btn-success"
                                style="margin-bottom: 6px">
                                <span><i class="fas fa-file-export"></i>Export</span>
                            </button>
                        </div>
                        <div class="col-sm-5 text-right">
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
                        <div class="alert alert-danger print-error-msg row" style="display:none">
                            <ul></ul>
                        </div>
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
        <div class="row">
            <div class="modal fade popupCustomer" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                @include('customer.popupAddCustomer')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery.tabledit.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var dataTemp = [];
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
                select: true,
                dom: "<'row'<'col-sm-4'i><'col-sm-8 text-center'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 text-center'p>>",
                ajax: {
                    url: "{{ route('customers.getData') }}",
                    data: function(d) {
                        d.name = $("#filterName").val() ?? '';
                        d.email = $("#filterEmail").val() ?? '';
                        d.address = $("#filterAddress").val() ?? '';
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

            $('#customerList').on('draw.dt', function() {
                $('#customerList').Tabledit({
                    url: '{{ route('customers.update') }}',
                    dataType: 'json',
                    columns: {
                        identifier: [0, 'customer_id'],
                        editable: [
                            [1, 'customer_name'],
                            [2, 'email'],
                            [3, 'address'],
                            [4, 'tel_num'],
                        ]
                    },
                    restoreButton: false,
                    deleteButton: false,
                    buttons: {
                        edit: {
                            class: 'btn btn-sm btn-warning',
                            html: '<span class="fa fa-edit"></span>',
                            action: 'edit'
                        }
                    },
                    onSuccess: function(data, textStatus, jqXHR) {
                        Swal.fire("{{ __('Notification') }}",
                            "{{ __('Edit success') }}", 'success');
                        customerTable.ajax.reload();
                        removeMsgEdit();
                    },
                    onFail: function(data) {
                        printErrorMsg(data.responseJSON.errors);
                        customerTable.ajax.reload();
                    },

                });
            });
            // validate signup form on keyup and submit
            var validator = $("#addCustomerForm").validate({
                rules: {
                    txtName: {
                        required: true,
                        minlength: 5,
                        maxlength:50
                    },
                    txtEmail: {
                        required: true,
                        email: true,
                        maxlegnth:150
                    },
                    txtAddress: {
                        required: true,
                        maxlength:100,
                    },
                    txtTel_num: {
                        required: true,
                        digits: true,
                        maxlength: 12,
                        minlength: 10
                    },
                },
                messages: {
                    txtName: {
                        required: "{{ __('CustomerRequired') }}",
                        minlength: "{{ __('CustomerMinlength') }}",
                        maxlength: "{{ __('name.max') }}",
                    },
                    txtEmail: {
                        required: "{{ __('EmailRequired') }}",
                        email: "{{ __('EmailType') }}",
                        maxlegnth: "{{ __('email.max') }}",
                    },
                    txtAddress: {
                        required: "{{ __('address.required') }}",
                        maxlength: "{{ __('address.max') }}",
                    },
                    txtTel_num: {
                        required: "{{ __('tel_num.required') }}",
                        digits: "{{ __('tel_num.regex') }}",
                        maxlength: "{{ __('tel_num.max') }}",
                        minlength: "{{ __('tel_num.min') }}",
                    },
                },
                submitHandler: function(form, e) {
                    e.preventDefault();

                    var formData = new FormData(form);
                    formData.append('is_active',$('#is_active').val());
                    $.ajax({
                        url: "/customers",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            $("#closePopup").trigger("click");
                            if (result['status'] === 'success') {
                                Swal.fire(
                                    "{{ __('Notification') }}",
                                    "{{ __('Add success') }}",
                                    'success');
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
                removeMsgEdit();
                customerTable.ajax.reload();
            });

            // Xử lý search dữ liệu cho customerList
            $('#btnSearch').on('click', function(e) {
                e.preventDefault();
                removeMsgEdit();
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
                $("#txtName").val('');
                $("#txtEmail").val('');
                $("#txtTel_num").val('');
                $("#txtAddress").val('');
                $("#is_active").prop('selectedIndex', 0);
                removeMsgEdit();
            }

            // clear error message
            function clearMessages() {
                $("#txtName-error").val('');
                $("#txtEmail-error").val('');
                $("#txtTel_num-error").val('');
                $("#txtAddress").val('');
                removeMsgEdit();
                validator.resetForm();
            };

            function removeMsgEdit() {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'none');
            }

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
            // Reset Form AddUser
            $('#btnAdd').on('click', function() {
                clearMessages();
                initCustomerForm();
            });

            var customerID = null;
            // Xử lý import customers
            $('body').on('change', '#import', function(e) {
                e.preventDefault();
                removeMsgEdit();
                var file_data = $('#import').prop('files')[0];

                var formData = new FormData();
                formData.append('file', file_data);

                $.ajax({
                    url: "{{ route('customers.import') }}",
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
                        }
                    },
                    error: function(err) {
                        if (err.responseJSON.errors) {
                            printErrorMsg(err.responseJSON.errors);
                        } else {
                            $(".print-error-msg").css('display', 'block');
                            $(".print-error-msg").find("ul").append('<li>' + err.responseJSON.message + '</li>');
                        }
                    }
                });
                customerTable.ajax.reload();
            });

            // Xử lý export customers
            $('body').on('click', '#btnExport', function(e) {
                e.preventDefault();
                var name = $("#filterName").val();
                var email = $("#filterEmail").val();
                var address = $("#filterAddress").val();
                var active = $("#checkActive").val();
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
                clearMessages();
                initCustomerForm();
            })
        });
    </script>
@stop
