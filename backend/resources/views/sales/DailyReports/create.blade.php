@extends('layouts.sales.base')
@section('content')
    <daily-report-create
    :form-url="{{ json_encode(route('dailyReport.store')) }}"
    :message="{{ json_encode(isset($message) ? $message : '') }}"
    :top-url="{{ json_encode(route('home')) }}"
    :date = "{{ json_encode(Carbon\Carbon::now()->format('Y年m月d日')) }}"
    :th = "{{ json_encode(App\Enums\DayOffWeek::getThJp(Carbon\Carbon::now()->format('l'))) }}"
    >
    </daily-report-create>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
