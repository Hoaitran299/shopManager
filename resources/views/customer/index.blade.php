@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Customers')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@stop

@section('content')
    @include('layouts.header')
    <div class="container-fluid pr-0 pl-0">
        <div class="row">
            <h4 class="ml-3"><strong>Customers List</strong></h4>
            <hr>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('Fullname') }}</label>
                                <input id='name' name='name' type="text" class="form-control"
                                    placeholder="Nhập {{ trans('Fullname') }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input id='email' name='email' type="text" class="form-control"
                                    placeholder="Nhập email">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('Active') }}</label>
                                {!! Form::select('is_active', [0 => 'Tạm khóa', 1 => 'Đang hoạt động'], null, [
                                    'placeholder' => 'Chọn trạng thái...',
                                    'class' => 'form-control',
                                    'id' => 'is_active',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>{{ trans('Address') }}</label>
                                <input id='address' name='address' type="text" class="form-control"
                                    placeholder="Nhập địa chỉ">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-left">
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".popupCustomer"><i class="fa fa-user-plus fa-border"></i><span> Thêm
                                    mới</span></button>
                        </div>
                        <div class="col-md-10 text-right">
                            <button id="btnSearch" name="btnSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-search fa-border"></i><span> Tìm
                                    kiếm</span></button>
                            <button id="btnDelSearch" name="btnDelSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-border">X</i><span> Xoá tìm
                                    kiếm</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        <div class="row" style="margin:0.25rem">
            <div class="card">
                <div class="table-responsive" style="margin-top:0.25rem">
                    <table class="table table-hover customerList" id="customerList" name="customerList">
                        <thead>
                            <tr class="bg-danger">
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

        <div class="row">
            <div class="modal fade popupCustomer" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                @include('customer.popupAddCustomer')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> --}}
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js">
        //<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript">
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // validate signup form on keyup and submit
        $(document).ready(function() {
            //var validator = $("#addCustomerForm").validate();
            $("#addCustomerForm").validate({
                onkeyup: function(element) {
                    this.element(element);
                },
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    inputName: {
                        required: true,
                        minlength: 5
                    },
                    inputEmail: {
                        required: true,
                        email: true
                    },
                    inputAddress: {
                        required: true,
                    },
                    inputPhone: {
                        required: true,
                        digits: true,
                        max: 9999999999,
                    },
                },
                messages: {
                    inputName: {
                        required: "{{ __('CustomerRequired') }}",
                        minlength: "{{ __('CustomerMinlength') }}",
                    },
                    inputEmail: {
                        required: "{{ __('EmailRequired') }}",
                        email: "{{ __('EmailType') }}",
                    },
                    inputAddress: {
                        required: "{{ __('address.required') }}",
                    },
                    inputPhone: {
                        required: "{{ __('PasswordConfirmRequired') }}",
                        digits: "{{ __('tel_num.regex') }}",
                        max: "{{ __('tel_num.max') }}",
                    },
                },
                submitHandler: function(form) {
                    console.log('aaaaaaaaaa');
                    // $('body').on('click', '#btnAddCustomer', function(event) {
                    //         event.preventDefault();

                    //     var name = $("#inputName").val();
                    //     var email = $("#inputEmail").val();
                    //     var tel = $("#inputPhone").val();
                    //     var address = $("#inputAddress").val();
                    //     var active = ($("#checkActive").val()) === "on" ? 1 : 0;
                    //     console.log('aaaaaaaaaa');
                    //     $.ajax({
                    //         url: "{{ route('customers.store') }}",
                    //         type: "POST",
                    //         data: {
                    //             name: name,
                    //             email: email,
                    //             tel_num: tel,
                    //             address: address,
                    //             is_active: active,
                    //         },
                    //         dataType: 'json',
                    //         success: function(result) {
                    //             console.log(result);
                    //             if (result['status'] === 'success') {
                    //                 Swal.fire(
                    //                     "{{ __('Notification') }}",
                    //                     "{{ __('Add success') }}",
                    //                     'success');
                    //                 customerTable.ajax.reload();
                    //             } else {
                    //                 Swal.fire(
                    //                     "{{ __('Notification') }}",
                    //                     "{{ __('Add error') }}",
                    //                     'error');
                    //             }
                    //         },
                    //         // beforeSend: function() {
                    //         //     clearMessages();
                    //         // }
                    //     });
                    // });
                    // return false;
                }
            });
        });
        $(document).ready(function() {
            var $table = $('#customerList');

            // Get data lên DataTable
            var customerTable = $('#customerList').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                pageLength: 10,
                ajax: {
                    url: "{{ route('customers.getData') }}",
                    data: function(d) {
                        d.name = $("#name").val() ?? '';
                        d.email = $("#email").val() ?? '';
                        d.address = $("#inputAddress").val() ?? '';
                        d.active = $("#is_active").val() ?? '';
                    }
                },
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [10, 20],
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
                            return $btn;
                        },
                        orderable: false,
                        serachable: false
                    },
                ],
                drawCallback: function() {
                    var page_min = 1;
                    var $api = this.api();
                    var pages = $api.page.info().pages;
                    var rows = $api.data().length;

                    if (rows < page_min) {
                        $table
                            .next('.dataTables_info').css('display', 'none')
                            .next('.dataTables_paginate').css('display', 'none')
                            .next('.dataTables_length').css('display', 'none');

                    } else if (pages === 1) {
                        $table
                            .next('.dataTables_info').css('display', 'none')
                            .next('.dataTables_paginate').css('display', 'none');
                    } else {
                        $table
                            .next('.dataTables_info').css('display', 'block')
                            .next('.dataTables_paginate').css('display', 'block');
                    }
                },
                language: {
                    processing: "{{ __('processing') }}",
                    lengthMenu: "{{ __('lengthMenu') }}",
                    info: "{{ __('showPage') }}",
                    infoEmpty: "{{ __('infoEmpty') }}",
                    emptyTable: "{{ __('infoEmpty') }}",
                },
            });

            // Xử lý xoá textbox search
            $('#btnDelSearch').on('click', function(e) {
                $('#is_active').prop('selectedIndex', 0);
                $('#inputAddress').val('');
                $('#name').val('');
                $('#email').val('');
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
            function initUserForm() {
                $("#inputName").val('');
                $("#inputEmail").val('');
                $("#inputPhone").val('');
                $("#checkActive").empty();
                $("#inputAddress").prop('selectedIndex', 0);
            }

            // clear error message
            // function clearMessages() {
            //     $("#errName").val('');
            //     $("#errEmail").val('');
            //     // $("#errPassword").val('');
            //     // $("#errPasswordConfirm").val('');
            //     validator.resetForm();
            // }

            // Reset Form AddUser
            $('#btnAdd').on('click', function() {
                //clearMessages();
                initUserForm();
            });

            var customerID = null;

            // Get user cho popupEditCustomer
            $(document).on('click', '.popupEditCustomer', function() {
                //clearMessages();
                $('#popupTitle').html("{{ __('Edit user') }}")
                var id = $(this).data("id");
                var customer = getCustomerByID(id);
                if (customer != null) {
                    customerID = customer.customer_id;
                    $('#btnAddCustomer').attr('id', 'btnEditCustomer');
                    $("#inputName").val(customer.customer_name);
                    $("#inputEmail").val(customer.email);

                    if (customer.is_active === 1) {
                        $('#checkActive').bootstrapToggle('on');
                    } else {
                        $('#checkActive').bootstrapToggle('off');
                    }
                } else {
                    Swal.fire("{{ __('Notification') }}", "{{ __('User not found') }}", 'error');
                }
            })

            // Xử lý sửa thông tin user
            $('body').on('click', '#btnEditCustomer', function(e) {
                e.preventDefault();

                //clearMessages();
                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                // var password = $("#inputPassword").val();
                // var password_confirmation = $("#inputPasswordConfirm").val();
                var address = $("#inputAddress").val();
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

            // Reset addCustomerForm sau khi close popup
            $(document).on('click', '#closePopup', function() {
                $('#popupTitle').html("{{ __('TitleAddUser') }}")
                clearMessages();
                initUserForm();
            })
        });
    </script>
@stop
