@extends('default.layout')

@section('title', 'Супер блог')

@section('content')
<div class="row">
    <div class="col-lg-12 content-center">
        @include('default.top-menu')
        @yield('center')
    </div>
</div>
@endsection