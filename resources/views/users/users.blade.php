@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Users')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
@stop

@section('content')
    {{-- @include('sweetalert::alert') --}}
    @include('layouts.header')
    <div class="container-fluid pr-0 pl-0">
        <div class="row">
            <h4 class="ml-3"><strong>User List</strong></h4>
            <hr>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tên</label>
                                <input id='name' name='name' type="text" class="form-control"
                                    placeholder="Nhập họ tên">
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
                                <label>Nhóm</label>
                                {!! Form::select('group_role', ['Admin' => 'Admin', 'Editor' => 'Editor', 'Reviewer' => 'Reviewer'], null, [
                                    'placeholder' => 'Chọn nhóm...',
                                    'class' => 'form-control',
                                    'id' => 'group_role',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                {!! Form::select('is_active', [0 => 'Tạm khoá ', 1 => 'Đang hoạt động'], null, [
                                    'placeholder' => 'Chọn trạng thái...',
                                    'class' => 'form-control',
                                    'id' => 'is_active',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-left">
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".popupUser"><i class="fa fa-user-plus fa-border"></i><span> Thêm
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
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover userList " id="userList" name="userList">
                    <thead>
                        <tr class="bg-danger">
                            <th style="width: 10px">#</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="modal fade popupUser" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                @include('users.popupEditAddUser')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var $table = $('#userList');

             // Get data lên DataTable
            var usersTable = $('.userList').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                pageLength: 10,
                ajax: {
                    url: "{{ route('user.getData') }}",
                    data: function(d) {
                        d.name = $("#name").val() ?? '';
                        d.email = $("#email").val() ?? '';
                        d.role = $("#group_role").val() ?? '';
                        d.active = $("#is_active").val() ?? '';
                    }
                },
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [10, 20],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'group_role',
                        name: 'group_role'
                    },
                    {
                        data: 'is_active',
                        render: function(data) {
                            var str = "";
                            if (data === 1) {
                                str =
                                    "<span class='text-left text-success'>Đang hoạt động</span>";
                            } else {
                                str = "<span class='text-left text-danger'>Tạm khoá</span>";
                            }
                            return str;
                        },
                    },
                    {
                        data: null,
                        render: function(data) {
                            $id = data["id"];
                            $btn = '<button type="button" id="popupEdit-' + $id + '" data-id="' +
                                $id +
                                '" data-toggle="modal" data-target=".popupUser" class="btn btn-info popupEditUser"><i class="fa fa-edit"></i></button>';
                            $btn = $btn + ' <button type="button" id="delD-' + $id +
                                '" name="delD-' + $id + '" data-id="' + $id +
                                '" class="btn btn-danger removeUser" ><i class="fa fa-trash"></i></button>';
                            if (data["is_active"] === 1) {
                                $btn = $btn + ' <button type="button" id="lockID-' + $id +
                                    '" name="lockID-' + $id + '"data-id="' + $id +
                                    '" class="btn btn-default lockUser"><i class="fa fa-user-lock"></i></button>';
                            } else {
                                $btn = $btn + ' <button type="button" id="lockID-' + $id +
                                    '" name="lockID-' + $id + '"data-id="' + $id +
                                    '" class="btn btn-default lockUser"><i class="fa fa-unlock"></i></button>';
                            }
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
                $('#group_role').prop('selectedIndex', 0);
                $('#name').val('');
                $('#email').val('');
                usersTable.ajax.reload();
            });

            // Xử lý search dữ liệu cho userList
            $('#btnSearch').on('click', function(e) {
                console.log($('#is_active').val());
                e.preventDefault();
                usersTable.ajax.reload();

            })

            // Get thông tin user by ID
            function getUserByID(id) {
                var user = null;
                $.ajax({
                    url: "/users/info/" + id,
                    type: "GET",
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        user = data.data;
                    },
                });
                return user;
            }

            // Xử lý xoá user is_delete = 1
            $(document).on('click', '.removeUser', function(e) {
                var id = $(this).data("id");
                var user = getUserByID(id);
                var cfm = "{{ __('Confirm delete') }}" + " " + user.name + " ?"
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
                            url: "/users/" + id,
                            type: "delete",
                            async: false,
                            success: function(result) {
                                if (result['status'] === 'success') {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Delete success') }}", 'success');
                                    usersTable.ajax.reload();
                                } else {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Delete error') }}", 'error');
                                }
                            },
                        });
                    }
                })
            });

             // Xử lý xoá user is_delete = 1
            $(document).on('click', '.lockUser', function(e) {
                var id = $(this).data("id");
                var user = getUserByID(id);
                var active = user.is_active;
                var cfm = (active === 1) ? "{{ __('Confirm lock') }}" + " " + user.name + " ?" :
                    "{{ __('Confirm unlock') }}" + " " + user.name + " ?"
                console.log(cfm);
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
                            url: "/users/" + id,
                            type: "post",
                            async: false,
                            success: function(result) {
                                if (result['status'] === 'success') {
                                    if (active === 1) {
                                        Swal.fire("{{ __('Notification') }}",
                                            "{{ __('Unlock success') }}", 'success'
                                        );
                                    } else {
                                        Swal.fire("{{ __('Notification') }}",
                                            "{{ __('Lock success') }}", 'success');
                                    }
                                    usersTable.ajax.reload();
                                } else {
                                    if (active === 1) {
                                        Swal.fire("{{ __('Notification') }}",
                                            "{{ __('Unlock error') }}", 'error');
                                    } else {
                                        Swal.fire("{{ __('Notification') }}",
                                            "{{ __('Lock error') }}", 'error');
                                    }
                                }
                            },
                        });
                    }
                })
            });

            var validator = $("#inputForm").validate();

            // Reset PopupEditAddUser
            function initUserForm() {
                $("#inputName").val('');
                $("#inputEmail").val('');
                $("#inputPassword").val('');
                $("#inputPasswordConfirm").val('');
                $("#checkActive").empty();
                $("#selGroupRole").prop('selectedIndex', 1);
                validator.resetForm();
            }

            // validate signup form on keyup and submit
            $("#inputForm").validate({
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
                    inputPassword: {
                        required: true,
                        minlength: 5,
                        pwcheck: true
                    },
                    inputPasswordConfirm: {
                        required: true,
                        equalTo: "#inputPassword"
                    },
                    selGroupRole: {
                        required: true,
                    },

                },
                messages: {
                    inputName: {
                        required: "{{__('UserRequired')}}",
                        minlength: "{{__('UserMinlength')}}",
                    },
                    inputEmail: {
                        required: "{{__('EmailRequired')}}",
                        email: "{{__('EmailType')}}",
                    },
                    inputPassword: {
                        required: "{{__('PasswordRequired')}}",
                        minlength: "{{__('PasswordMinlength')}}",
                        pwcheck: "{{__('PasswordCheck')}}",
                    },
                    inputPasswordConfirm: {
                        required: "{{__('PasswordConfirmRequired')}}",
                        equalTo: "{{__('PasswordConfirmEqualTo')}}",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $('body').on('click', '#inputButton', function(e) {
                        e.preventDefault();
                        var name = $("#inputName").val();
                        var email = $("#inputEmail").val();
                        var password = $("#inputPassword").val();
                        var role = $("#selGroupRole").val();
                        var active = ($("#checkActive").val()) === "on" ? 1 : 0;

                        $.ajax({
                            url: "{{ route('user.create') }}",
                            type: "POST",
                            data: {
                                name: name,
                                email: email,
                                password: password,
                                group_role: role,
                                is_active: active,
                            },
                            async: false,
                            success: function(result) {
                                console.log(result);
                                if (result['status'] === 'success') {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Add success') }}", 'success');
                                    usersTable.ajax.reload();
                                } else {
                                    Swal.fire("{{ __('Notification') }}",
                                        "{{ __('Add error') }}", 'error');
                                }
                            },
                            beforeSend: function() {
                                initUserForm();
                            },
                        });
                    });
                    return false;
                }
            });

            // check validate password
            $.validator.addMethod("pwcheck", function(value) {
                return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/.test(
                        value) // consists of only these
                    &&
                    /[a-z]/.test(value) // has a lowercase letter
                    &&
                    /\d/.test(value) // has a digit
                    &&
                    /[#?!@$%^&*-]/.test(value) // has special character
            });

            var userID = null;

            // Get user cho popupEditUser
            $(document).on('click', '.popupEditUser', function() {
                $('#popupTitle').html("{{ __('Edit user') }}")
                var idUSer = $(this).data("id");
                var user = getUserByID(idUSer);
                if (user != null) {
                    userID = user.id;
                    $('#addUserButton').attr('id', 'editUserButton');
                    $("#inputName").val(user.name);
                    $("#inputEmail").val(user.email);
                    console.log(user.group_role);
                    $('select option:contains("'+user.group_role+'")').prop('selected',true);
                    if (user.is_active === 1) {
                        $('#checkActive').bootstrapToggle('on');
                    } else {
                        $('#checkActive').bootstrapToggle('off');
                    }
                } else {
                    Swal.fire("{{ __('Notification') }}", "{{ __('User not found') }}", 'error');
                }
            })

            // Xử lý sửa thông tin user
            $('body').on('click', '#editUserButton', function(e) {
                e.preventDefault();
                var name = $("#inputName").val();
                var email = $("#inputEmail").val();
                var password = $("#inputPassword").val();
                var password_confirmation = $("#inputPasswordConfirm").val();
                var role = $("#selGroupRole").val();
                var active = ($("#checkActive").val()) === "on" ? 1 : 0;

                $.ajax({
                    url: '/users/update' + userID,
                    type: "PUT",
                    data: {
                        id: userID,
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation,
                        group_role: role,
                        is_active: userStatus,
                        _method: 'PUT',
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#closePopup").trigger("click");
                        if (result['status'] === 'success') {
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Edit success') }}", 'success');
                            usersTable.ajax.reload();
                        } else {
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Edit error') }}", 'error');

                        }
                    },
                    beforeSend: function() {
                        initUserForm();
                    },
                });
            });
        });
    </script>
@stop
