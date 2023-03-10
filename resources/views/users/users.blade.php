@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Users')

@section('styles')

@stop

@section('content')
    @php
        $TitlePage = 'Danh sách User';
        $redirect = '#';
        $childMenu = '';
    @endphp
    @include('layouts.header')
    <div class="container-fluid pr-0 pl-0">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tên</label>
                                <input id='txtName' name='txtName' type="text" class="form-control"
                                    placeholder="Nhập họ tên">
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
                                <label>Nhóm</label>
                                {!! Form::select('selGroup_role', ['Admin' => 'Admin', 'Editor' => 'Editor', 'Reviewer' => 'Reviewer'], null, [
                                    'placeholder' => 'Chọn nhóm...',
                                    'class' => 'form-control',
                                    'id' => 'selGroup_role',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                {!! Form::select('checkActive', [0 => 'Tạm khoá ', 1 => 'Đang hoạt động'], null, [
                                    'placeholder' => 'Chọn trạng thái...',
                                    'class' => 'form-control',
                                    'id' => 'checkActive',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-left">
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".popupUser"><i class="fa fa-user-plus fa-border"></i><span>
                                    {{ __('Add') }}</span></button>
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
                            <table class="table table-hover userList " id="userList" name="userList">
                                <thead>
                                    <tr class="bg-primary">
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
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="modal fade popupUser" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                @include('users.popupEditAddUser')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var $table = $('#userList');
            var action = "add";
            $.fn.DataTable.ext.pager.numbers_length = 10;
            var usersTable = $('.userList').DataTable({
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
                    url: "{{ route('user.getData') }}",
                    data: function(d) {
                        d.name = $("#txtName").val() ?? '';
                        d.email = $("#txtEmail").val() ?? '';
                        d.role = $("#selGroup_role").val() ?? '';
                        d.active = $("#checkActive").val() ?? '';
                    }
                },
                order: [0,"desc"],
                lengthChange: false,
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
                            $email = data['email'];
                            $btn = '<button type="button" id="popupEdit-' + $id + '" data-id="' +
                                $id +
                                '" data-toggle="modal" data-target=".popupUser" class="btn btn-info popupEditUser"><i class="fa fa-edit"></i></button>';

                            if ($email != "admin@gmail.com") {
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
                            }
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

            // Xử lý ADD - EDIT USER POPUP
            // validate signup form on keyup and submit
            var validator = $("#userForm").validate({
                onkeyup: function(element) {
                    this.element(element);
                    checkValidatePasssword();
                },
                onfocusout: function(element) {
                    this.element(element);
                },
                rules: {
                    name: {
                        required: true,
                        minlength: 5,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50,
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        //pwReg: true,
                        maxlength: 30,
                    },
                    password_confirm: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    group_role: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "{{ __('UserRequired') }}",
                        minlength: "{{ __('UserMinlength') }}",
                        maxlength: "{{ __('name.max') }}",
                    },
                    email: {
                        required: "{{ __('email.required') }}",
                        email: "{{ __('EmailType') }}",
                        maxlength: "{{ __('email.max') }}",
                    },
                    password: {
                        required: "{{ __('PasswordRequired') }}",
                        minlength: "{{ __('PasswordMinlength') }}",
                        maxlength: "{{ __('password.max') }}",
                        pwReg: "{{ __('password.regex') }}",
                    },
                    password_confirm: {
                        required: "{{ __('PasswordConfirmRequired') }}",
                        minlength: "{{ __('PasswordConfirmMinlength') }}",
                        equalTo: "{{ __('PasswordConfirmEqualTo') }}",
                    },
                },
                submitHandler: function(form, e) {
                    clearMessages();
                    checkValidatePasssword();
                    e.preventDefault();
                    var formData = new FormData(form);
                    formData.delete('is_active');
                    formData.append('is_active', $("#is_active").prop('checked'));

                    if (action === "add") {
                        $.ajax({
                            url: "/users",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                usersTable.ajax.reload(null,false);
                                $("#closePopup").trigger("click");
                                Swal.fire("{{ __('Notification') }}",
                                    "{{ __('Add success') }}",
                                    'success');
                            },
                            error: function(error) {
                                $.each(error.responseJSON.errors, function(key, value) {
                                    $("#" + key + '-error').html(value[0]);
                                    $("#" + key + '-error').css('display', 'block');
                                });
                            }
                        });
                    } else {
                        $("#email").attr('disabled', false);
                        var email = $("#email").val();

                        $("#email").attr('disabled', true);
                        formData.append('email', email);
                        $.ajax({
                            url: '/users/update/' + userID,
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                usersTable.ajax.reload(null,false);
                                $("#closePopup").trigger("click");
                                Swal.fire("{{ __('Notification') }}",
                                    "{{ __('Edit success') }}", 'success');
                            },
                            error: function(error) {
                                $.each(error.responseJSON.errors, function(key, value) {
                                    $("#" + key + '-error').html(value[0]);
                                    $("#" + key + '-error').css('display', 'block');
                                });
                            }
                        });
                    }

                    return false;
                }
            });

            $.validator.addMethod("pwReg", function(value) {
                return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{5,}$/.test(value) // consists of only these
                    &&
                    /[a-z]/.test(value) // has a lowercase letter
                    &&
                    /\d/.test(value) // has a digit
            });

            function checkValidatePasssword() {
                //Add rules in validation
                var pass = $('#password').val();
                if (action === "edit" && pass === "") {
                    $("#password").rules("remove");
                    $("#password_confirm").rules("remove");
                } else {
                    $("#password").rules("add", {
                        required: true,
                        minlength: 5,
                        pwReg: true,
                        maxlength: 30
                    });
                    $("#password_confirm").rules("add", {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    });
                }
            };

            // Xử lý xoá textbox search
            $('#btnDelSearch').on('click', function(e) {
                $('#checkActive').prop('selectedIndex', 0);
                $('#selGroup_role').prop('selectedIndex', 0);
                $('#txtName').val('');
                $('#txtEmail').val('');
                usersTable.ajax.reload();
            });

            // Xử lý search dữ liệu cho userList
            $('#btnSearch').on('click', function(e) {
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
                var cfm = "{{ __('Confirm delete user') }}" + " " + user.name + " ?"
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
                                Swal.fire("{{ __('Notification') }}",
                                    "{{ __('Delete success') }}", 'success');
                                usersTable.ajax.reload(null,false);
                            },
                        });
                    }
                })
            });

            // Xử lý xoá user is_lock = 1
            $(document).on('click', '.lockUser', function(e) {
                var id = $(this).data("id");
                var user = getUserByID(id);
                var active = user.is_active;
                var cfm = (active === 1) ? "{{ __('Confirm lock') }}" + " " + user.name + " ?" :
                    "{{ __('Confirm unlock') }}" + " " + user.name + " ?"
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
                                    usersTable.ajax.reload(null,false);
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

            // Reset PopupEditAddUser
            function initUserForm() {
                $("#name").val('');
                $("#email").val('');
                $("#email").attr('disabled', false);
                $("#password").val('');
                $("#password_confirm").val('');
                $("#is_active").val();
                $("#group_role").prop('selectedIndex', 0);
            };

            // clear error message
            function clearMessages() {
                $("#name-error").empty();
                $("#email-error").empty();
                $("#password-error").empty();
                $("#password_confirm-error").empty();
                validator.resetForm();
            };

            // Reset Form AddUser
            $('#btnAdd').on('click', function() {
                $('#popupTitle').html("{{ __('TitleAddUser') }}");
                action = "add";
                $("#email").attr('disabled', false);
                clearMessages();
                initUserForm();
            });

            var userID = null;

            // Get user cho popupEditUser
            $(document).on('click', '.popupEditUser', function() {
                clearMessages();
                action = "edit";

                $('#popupTitle').html("{{ __('Edit user') }}")
                $("#email").attr('disabled', true);

                //Delete rules in validation
                checkValidatePasssword();

                var idUSer = $(this).data("id");
                var user = getUserByID(idUSer);
                if (user != null) {
                    userID = user.id;
                    $("#name").val(user.name);
                    $("#email").val(user.email);
                    $('select#group_role option:contains("' + user.group_role + '")').prop(
                        'selected',
                        true);
                    if (user.is_active === 1) {
                        $('#is_active').bootstrapToggle('on');
                    } else {
                        $('#is_active').bootstrapToggle('off');
                    }
                } else {
                    Swal.fire("{{ __('Notification') }}", "{{ __('User not found') }}", 'error');
                }
            });

            // Reset userForm sau khi close popup
            $(document).on('click', '#closePopup', function() {
                $('#popupTitle').html("{{ __('TitleAddUser') }}")
                action = "add";
                clearMessages();
                initUserForm();
                checkValidatePasssword();
            });
        });
    </script>
@stop
