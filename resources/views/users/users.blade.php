@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Users')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@stop

@section('content')
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
                                {!! Form::select('group_role', [1 => 'Admin', 2 => 'Editor', 3 => 'Reviewer'], null, [
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
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary"><i
                                    class="fa fa-user-plus fa-border"></i><span> Thêm mới</span></button>
                        </div>
                        <div class="col-md-10 text-right">
                            <button id="btnSearch" name="btnSearch" type="button" class="btn btn-success"><i
                                    class="fa fa-search fa-border"></i><span> Tìm
                                    kiếm</span></button>
                            <button id="btnRemove" name="btnRemove" type="button" class="btn btn-success"><i
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
                        <tr class="table-danger">
                            <th style="width: 10px">#</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->group_role }}</td>
                        <td>{{ $user->is_active}}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('user.edit',$user->id) }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('user.destroy',$user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <form action="{{ route('user.lock',$user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-user-lock"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var $table = $('#userList');

            var usersTable = $('.userList').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: "{{ route('user.index') }}",
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
                                str = "Đang hoạt động";
                            } else {
                                str = "Tạm khoá";
                            }
                            return str;
                        },
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // console.log(data);
                            console.log(row);
                            var html =
                                '<a class="btn btn-info" href="#"><i class="fas fa-edit"></i></a>' +
                                '<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>' +
                                '<button type="submit" class="btn btn-default"><i class="fas fa-user-lock"></i></button>';
                            return html;
                        },
                        orderable: false,
                        searchable: false
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

            function getSearchUsers() {
                var name = document.getElementById("name").value;
                var email = document.getElementById("email").value;
                var group_role = document.getElementById("group_role").value;
                var is_active = document.getElementById("is_active").value;


            }

            $('#btnRemove').on('click', function(e) {
                $('#is_active').prop('selectedIndex', -1);
                $('#group_role').prop('selectedIndex', -1);
                $(':input').val('');
            });

            $('#btnSearch').on('click', function(e) {
                var name = $("#name").val();
                var email = $("#email").val();
                var role = $("#group_role").val();
                var is_active = $('#is_active').val();
                e.preventDefault();
                if ((name != '') && (email != '') && (role === null) && (is_active === null)) {
                    dataSearch = {
                        name: name,
                        email: email,
                        role: role,
                        is_active: is_active
                    };
                }
            })

            function getUserByID(id) {
                var user = null;
                $.ajax({
                    url: base_url + '/users/' + id,
                    type: "GET",
                    async: false,
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        user = data;
                    },
                    error: function(err) {
                        alert('Somethings went wrong!');
                    },
                });
                return user.data;
            }
        });
    </script>
@stop
