@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Đăng nhập')

@section('styles')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="{{ asset('img/logo.png') }}" alt="RiverCrane Vietnam">
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <form action="{{ route('loginUser') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="input-group mb-1">
                                <input id="email" type="email" class="form-control" placeholder="Email" name="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" required autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <div class="row text-danger ml-1">
                                    <span><strong>{{ $errors->first('email') }}</strong></span>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="input-group mt-2 mb-1">
                                <input type="password" class="form-control" placeholder="Password" id="password"
                                    name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    value="{{ old('password') }}" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <div class="row text-danger ml-1">
                                    <span><strong>{{ $errors->first('password') }}</strong></span>
                                </div>
                            @endif
                        </div>

                        <div class="row mb-2">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
      </div>
@stop
@section('scripts')
    {{-- <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script> --}}
@stop
