@extends('layouts.sales.base')

@section('content')
    <sales-top
        :sales-management-url="{{ json_encode(route('salesManagement')) }}"
    ></sales-top>
@endsection

@section('javascript')
@endsection