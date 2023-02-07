@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Customers')

@section('styles')
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
                                <input id='txtAddress' name='txtAddress' type="text" class="form-control"
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
    <!-- jQuery -->
    <script type="text/javascript" src="//cdn.datatables.net/rowreorder/1.3.2/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // validate signup form on keyup and submit
        // $(document).ready(function() {
        //     $("#addCustomerForm").validate({
        //         onkeyup: function(element) {
        //             this.element(element);
        //         },
        //         onfocusout: function(element) {
        //             this.element(element);
        //         },
        //         rules: {
        //             name: {
        //                 required: true,
        //                 minlength: 5
        //             },
        //             email: {
        //                 required: true,
        //                 email: true
        //             },
        //             address: {
        //                 required: true,
        //             },
        //             tel_num: {
        //                 required: true,
        //                 digits: true,
        //                 max: 9999999999,
        //             },
        //         },
        //         messages: {
        //             name: {
        //                 required: "{{ __('CustomerRequired') }}",
        //                 minlength: "{{ __('CustomerMinlength') }}",
        //             },
        //             email: {
        //                 required: "{{ __('EmailRequired') }}",
        //                 email: "{{ __('EmailType') }}",
        //             },
        //             address: {
        //                 required: "{{ __('address.required') }}",
        //             },
        //             tel_num: {
        //                 required: "{{ __('PasswordConfirmRequired') }}",
        //                 digits: "{{ __('tel_num.regex') }}",
        //                 max: "{{ __('tel_num.max') }}",
        //             },
        //         },
        //         submitHandler: function(form) {
        //             console.log('aaaaaaaaaa');

        //             // return false;
        //         }
        //     });
        // });
        $(document).ready(function() {
            var $table = $('#customerList');

            // Get data lên DataTable
            var customerTable = $('#customerList').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                autoWidth: false,
                pagingType: "full_numbers_no_ellipses",
                pageLength: 10,
                dom: "<'row'<'col-sm-4'i><'col-sm-8 text-center'p>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 text-center'p>>",
                ajax: {
                    url: "{{ route('customers.getData') }}",
                    data: function(d) {
                        d.name = $("#txtName").val() ?? '';
                        d.email = $("#txtEmail").val() ?? '';
                        d.address = $("#txtAddress").val() ?? '';
                        d.active = $("#is_active").val() ?? '';
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
                    var page_min = 1;
                    var $api = this.api();
                    var pages = $api.page.info().pages;
                    var rows = $api.data().length;

                    if (rows < page_min) {
                        $table
                            .next('.dataTables_info').css('display', 'none')
                            .next('.paginate_button').css('display', 'none')
                            .next('.dataTables_length').css('display', 'none');

                    } else if (pages === 1) {
                        $table
                            .next('.dataTables_info').css('display', 'none')
                            .next('.paginate_button').css('display', 'none');
                    } else {
                        $table
                            .next('.dataTables_info').css('display', 'block')
                            .next('.paginate_button').css('display', 'block');
                    }
                },
                language: {
                    processing: "{{ __('processing') }}",
                    info: "{{ __('showPage') }}",
                    infoEmpty: "{{ __('infoEmpty') }}",
                    emptyTable: "{{ __('infoEmpty') }}",
                    paginate: {
                        first: "<<",
                        previous: "<",
                        next: ">",
                        last: ">>"
                    },
                },
            });

            // Xử lý xoá textbox search
            $('#btnDelSearch').on('click', function(e) {
                $('#is_active').prop('selectedIndex', 0);
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
            function initUserForm() {
                $("#name").val('');
                $("#email").val('');
                $("#tel_num").val('');
                $("#checkActive").empty();
                $("#address").prop('selectedIndex', 0);
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

            $(document).on('click', '#btnAddCustomer', function(event) {
                event.preventDefault();

                var name = $("#name").val();
                var email = $("#email").val();
                var tel = $("#tel_num").val();
                var address = $("#address").val();
                var active = ($("#checkActive").val()) === "on" ? 1 : 0;
                console.log('aaaaaaaaaa');
                $.ajax({
                    url: "{{ route('customers.store') }}",
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        tel_num: tel,
                        address: address,
                        is_active: active,
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result['status'] === 'success') {
                            Swal.fire(
                                "{{ __('Notification') }}",
                                "{{ __('Add success') }}",
                                'success');
                            customerTable.ajax.reload();
                        } else {
                            Swal.fire(
                                "{{ __('Notification') }}",
                                "{{ __('Add error') }}",
                                'error');
                        }
                    },
                });
            });
            var customerID = null;

            // Get user cho popupEditCustomer
            $('#customerList').on('mousedown', '.editCustomer', function() {
                //clearMessages();
                $('#popupTitle').html("{{ __('Edit user') }}")
                var id = $(this).data("id");
                var customer = getCustomerByID(id);
                if (customer != null) {
                    customerID = customer.customer_id;
                    $('.editCustomer').addClass("d-none");
                    $('.saveCustomer').removeClass("d-none");
                    var $row = $(this).closest("tr").off("mousedown");
                    var $tds = $row.find("td").not(':first').not(':last');
                    $.each($tds, function(i, el) {
                        var txt = $(this).text();
                        $(this).html("").append("<input type='text' value=\"" + txt + "\">");
                    });
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
            // Xử lý sửa thông tin user
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

            // Reset addCustomerForm sau khi close popup
            $(document).on('click', '#closePopup', function() {
                $('#popupTitle').html("{{ __('TitleAddUser') }}")
                clearMessages();
                initUserForm();
            })
        });
    </script>
@stop
