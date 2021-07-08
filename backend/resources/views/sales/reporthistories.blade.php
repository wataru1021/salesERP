@extends('layouts.sales.base')

@section('content')
<sales-report-histories
    :sales-management-url="{{ json_encode(URL::to('/sales_management')) }}"
    :top-page-url="{{ json_encode(URL::to('/top')) }}">
</sales-report-histories>
@endsection

@section('javascript')
@endsection