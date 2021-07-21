@extends('layouts.sales.base', ['isActiveHeader' => 'salesManagement'])

@section('content')
    <sales-management
        :report-registration-url="{{ json_encode(route('dailyReport.create')) }}"
        :check-past-results-url="{{ json_encode(route('sale.reportHistories')) }}"
        :top-page-url="{{ json_encode(URL::to('/')) }}"
    ></sales-management>
@endsection

@section('javascript')
@endsection