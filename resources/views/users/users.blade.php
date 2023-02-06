@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Users')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css') }}">
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
    <script src="{{ asset('adminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var $table = $('#userList');

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
                                '" data-toggle="modal" data-target=".popupUser" class="btn btn-info"><i class="fa fa-edit"></i></button>';
                            $btn = $btn + ' <button type="button" id="delD-' + $id +
                                '" name="delD-' + $id + '" data-id="' + $id +
                                '" class="btn btn-danger removeUser" ><i class="fa fa-trash"></i></button>';
                            if (data["is_active"] === 1) {
                                $btn = $btn + ' <button type="button" id="lockID-' + $id +
                                    '" name="lockID-' + $id + '"data-id="' + $id +
                                    '" class="btn btn-default"><i class="fa fa-user-lock"></i></button>';
                            } else {
                                $btn = $btn + ' <button type="button" id="lockID-' + $id +
                                    '" name="lockID-' + $id + '"data-id="' + $id +
                                    '" class="btn btn-default"><i class="fa fa-unlock"></i></button>';
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
                    processing: "Đang tiến hành tải dữ liệu",
                    lengthMenu: "Hiển thị 1 ~ _MENU_ ",
                    info: "Hiển thị từ _START_ ~ _END_ trong tổng số _TOTAL_ user",
                    infoEmpty: "Không có dữ liệu",
                    emptyTable: "Không có dữ liệu",
                },
            });

            $('#btnDelSearch').on('click', function(e) {
                $('#is_active').prop('selectedIndex', 0);
                $('#group_role').prop('selectedIndex', 0);
                $('#name').val('');
                $('#email').val('');
                usersTable.ajax.reload();
            });

            $('#btnSearch').on('click', function(e) {
                console.log($('#is_active').val());
                e.preventDefault();
                usersTable.ajax.reload();

            })

            function getUserByID(id) {
                var user = null;
                $.ajax({
                    url: "/users/info/" + id,
                    type: "GET",
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        user = data.data;
                    },
                });
                return user;
            }

            $(document).on('click', '.removeUser', function(e) {
                var id = $(this).data("id");
                var user = getUserByID(id);
                e.preventDefault();
                Swal.fire({
                    title: 'Nhắc nhở',
                    text: "Bạn muốn xóa thành viên " + user.name + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "users/" + id,
                            type: "delete",
                            async: false,
                            success: function($result) {
                                console.log($result);
                                if ($result['status'] === 'success') {
                                    Swal.fire('Thông báo', 'Người dùng đã bị xóa.','success');
                                    usersTable.ajax.reload();
                                } else {
                                    Swal.fire('Thông báo','không thể xóa được người dùng.', 'error');
                                }
                            },
                        });
                    }
                })
            });
        });
    </script>
@stop
