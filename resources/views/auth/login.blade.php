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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <span><strong>{{ $error }}</strong></span>
                            @endforeach
                        </div>
                    @endif
                    <form id="loginForm" action="{{ route('loginUser') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="input-group mb-1">
                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-left:1px solid #ccc">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <input id="email" type="text" class="form-control" placeholder="Email" name="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" autofocus autocomplete="NoAutocomplete"
                                    style="border-right:1px solid #ccc;width:80%">

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mt-2 mb-1">
                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-left:1px solid #ccc">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" id="password"
                                    name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    value="{{ old('password') }}" autocomplete="new-password"
                                    style="border-right:1px solid #ccc;width:80%">
                            </div>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#loginForm").validate({
            onkeyup: function(element) {
                this.element(element);
            },
            onfocusout: function(element) {
                this.element(element);
            },
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 50,
                },

                password: {
                    required: true,
                    //minlength: 5
                },
            },
            messages: {
                email: {
                    required: "{{ __('email.required') }}",
                    email: "{{ __('EmailType') }}",
                    maxlength: "{{ __('email.max') }}",
                },
                password: {
                    required: "{{ __('PasswordRequired') }}",
                    //minlength: "{{ __('PasswordMinlength') }}",
                }
            }
        });
    </script>
@stop
