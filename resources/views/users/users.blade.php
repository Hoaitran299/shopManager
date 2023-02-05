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
                                <select class="form-control" id='group_role' name='group_role' placeholder="Chọn nhóm">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control" id='status' name='status' placeholder="Trạng thái">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 text-left">
                            <button id="btnAdd" name="btnAdd" type="button" class="btn btn-primary"><i
                                    class="fa fa-user-plus fa-border"></i><span> Thêm mới</span></button>
                        </div>
                        <div class="col-md-10 text-right">
                            <button type="button" class="btn btn-success"><i class="fa fa-search fa-border"></i><span> Tìm
                                    kiếm</span></button>
                            <button type="button" class="btn btn-success"><i class="fa fa-border">X</i><span> Xoá tìm
                                    kiếm</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover userList" id="userList" name="userList">
                    <thead>
                        <tr class="table-info">
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
        $(document).ready( function () {
            var table = $('.userList').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ route('user.index') }}",
               columns: [
                   {data: 'id', name: 'id'},
                   {data: 'name', name: 'name'},
                   {data: 'email', name: 'email'},
               ]
           });
        } );
    </script>
@stop
