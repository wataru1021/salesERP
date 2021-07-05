@extends('layouts.sales.base')

@section('content')
    <daily-report-create
    :form-url="{{ json_encode(route('daily-report.store')) }}"
    :message="{{ json_encode(isset($message) ? $message : '') }}"
    :top-url="{{ json_encode(route('home')) }}"
    >
    </daily-report-create>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
