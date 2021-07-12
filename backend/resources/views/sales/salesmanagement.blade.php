@extends('layouts.sales.base')

@section('content')
    <sales-management
        :report-registration-url="{{ json_encode(URL::to('/daily-report/create')) }}"
        :check-past-results-url="{{ json_encode(URL::to('/report_histories')) }}"
        :top-page-url="{{ json_encode(URL::to('/')) }}"
    ></sales-management>
@endsection

@section('javascript')
@endsection