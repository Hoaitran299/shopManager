@extends('layouts.master')

@section('title', 'RiverCrane Vietnam - Sản phẩm')

@section('styles')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@stop

@section('content')
@include('layouts.header')
<div class="container-fluid pr-0 pl-0">
        <div class="row">
            <h2><strong>Product List</strong></h2>
        </div>
</div>
@stop
@section('scripts')
    {{-- <!-- AdminLTE App -->
    <script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script> --}}
@stop
