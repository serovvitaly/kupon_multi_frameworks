@extends('default2.layout')

@section('title', 'Супер блог')

@section('content')
@include('default2.top-menu')
<div class="row">
    <div class="col-lg-12 content-center">
        @yield('center')
    </div>
</div>
@endsection