@extends('layouts.sales.base')

@section('content')
    <sales-management
        :report-registration-url="{{ json_encode(URL::to('/daily-report/create')) }}"
        :check-past-results-url="{{ json_encode(URL::to('/check_past_results')) }}"
    ></sales-management>
@endsection

@section('javascript')

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/main.js') }}" defer></script>
@endsection