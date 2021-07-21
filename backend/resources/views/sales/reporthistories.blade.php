@extends('layouts.sales.base', ['isActiveHeader' => ''])

@section('content')
<sales-report-histories
    :sales-management-url="{{ json_encode(route('salesManagement')) }}"
    :top-page-url="{{ json_encode(URL::to('/')) }}">
</sales-report-histories>
@endsection

@section('javascript')
@endsection