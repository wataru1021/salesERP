@extends('layouts.sales.base')

@section('content')
    <sales-top
        :sales-management-url="{{ json_encode(URL::to('/sales_management')) }}"
    ></sales-top>
@endsection

@section('javascript')
@endsection