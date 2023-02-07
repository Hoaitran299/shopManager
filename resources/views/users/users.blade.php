@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Users')

@section('styles')

@stop

@section('content')
    @include('layouts.header')
    <div class="container-fluid pr-0 pl-0">
        <div class="row">
            <h4 class="ml-3"><strong>Users List</strong></h4>
            <hr>
        </div>
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
        <div class="row" style="margin:0.25rem">
            <div class="card">
                <div class="table-responsive dt-responsive nowrap" style="margin-top:0.25rem;width: 100%;">
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
        </div>

        <div class="row">
            <div class="modal fade popupUser" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                @include('users.popupEditAddUser')
            </div>
        </div>
    </div>
@stop
@section('scripts')
    
    <!-- jQuery -->
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    {{-- <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var $table = $('#userList');
            $.fn.DataTable.ext.pager.numbers_length = 10;

            // Get data lên DataTable
            var usersTable = $('.userList').DataTable({
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
                    url: "{{ route('user.getData') }}",
                    data: function(d) {
                        d.name = $("#txtName").val() ?? '';
                        d.email = $("#txtEmail").val() ?? '';
                        d.role = $("#group_role").val() ?? '';
                        d.active = $("#is_active").val() ?? '';
                    }
                },
                order: [
                    [0, 'desc']
                ],
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

            $(document).on('click', '#addUserButton', function(e) {
                e.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var passwordConfirm = $("#password_confirm").val();
                var role = $("#selGroupRole").val();
                var active = ($("#checkActive").val()) === "on" ? 1 : 0;
                console.log('add user');
                $.ajax({
                    url: "/users",
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        password_confirm: passwordConfirm,
                        group_role: role,
                        is_active: active,
                    },
                    success: function(result) {
                        console.log(result);
                        if (result['status'] === 'success') {
                            $("#closePopup").trigger("click");
                            Swal.fire("{{ __('Notification') }}", "{{ __('Add success') }}",
                                'success');
                        } else {
                            Swal.fire(
                                "{{ __('Notification') }}",
                                "{{ __('Add error') }}",
                                'error');
                        }
                    },
                    beforeSend: function() {
                        clearMessages();
                    }
                });
                usersTable.ajax.reload();
            });

            // Reset PopupEditAddUser
            function initUserForm() {
                $("#name").val('');
                $("#email").val('');
                $("#password").val('');
                $("#password_confirm").val('');
                $("#checkActive").empty();
                $("#selGroupRole").prop('selectedIndex', 0);
            };

            // clear error message
            function clearMessages() {
                $("#errName").val('');
                $("#errEmail").val('');
                $("#errPassword").val('');
                $("#errPasswordConfirm").val('');
            };
            // Reset Form AddUser
            $('#btnAdd').on('click', function() {
                clearMessages();
                initUserForm();
            });

            var validator = $("#addUserForm").validate();
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
                clearMessages();
                $('#popupTitle').html("{{ __('Edit user') }}")
                var idUSer = $(this).data("id");
                var user = getUserByID(idUSer);

                if (user != null) {
                    userID = user.id;
                    $('#addUserButton').attr('id', 'editUserButton');
                    $("#name").val(user.name);
                    $("#email").val(user.email);

                    $('select option:contains("' + user.group_role + '")').prop('selected', true);
                    if (user.is_active === 1) {
                        $('#checkActive').bootstrapToggle('on');
                    } else {
                        $('#checkActive').bootstrapToggle('off');
                    }
                } else {
                    Swal.fire("{{ __('Notification') }}", "{{ __('User not found') }}", 'error');
                }
            });

            // Xử lý sửa thông tin user
            $(document).on('click', '#editUserButton', function(e) {
                e.preventDefault();

                clearMessages();
                var name = $("#name").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var password_confirm = $("#password_confirm").val();
                var role = $("#selGroupRole").val();
                var active = ($("#checkActive").val()) === "on" ? 1 : 0;

                console.log('edit user');

                $.ajax({
                    url: '/users/update/' + userID,
                    type: "POST",
                    data: {
                        id: userID,
                        name: name,
                        email: email,
                        password: password,
                        password_confirm: password_confirm,
                        group_role: role,
                        is_active: active,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (result['status'] === 'success') {
                            Swal.fire("{{ __('Notification') }}",
                                "{{ __('Edit success') }}", 'success');
                            $('#editUserButton').attr('id', 'addUserButton');
                            $("#closePopup").trigger("click");
                            usersTable.ajax.reload();
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

            // Reset AddUserForm sau khi close popup
            $(document).on('click', '#closePopup', function() {
                $('#popupTitle').html("Thêm mới User")
                clearMessages();
                initUserForm();
            });
        });
    </script>
@stop
