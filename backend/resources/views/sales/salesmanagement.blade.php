@extends('layouts.sales.base')

@section('content')
    <sales-management
        :report-registration-url="{{ json_encode(URL::to('/daily-report/create')) }}"
        :check-past-results-url="{{ json_encode(URL::to('/check_past_results')) }}"
        :top-page-url="{{ json_encode(URL::to('/top')) }}"
    ></sales-management>
@endsection

@section('javascript')
@endsection