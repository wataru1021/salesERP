@extends('layouts.sales.base')

@section('content')
    <daily-report-complete
    :data="{{ json_encode(isset($data) ? $data : '') }}"
    :top-url="{{ json_encode(route('home')) }}"
    ></daily-report-complete>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
