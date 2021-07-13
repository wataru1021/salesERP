@extends('layouts.sales.base')

@section('content')
    <daily-report-complete
    :data="{{ json_encode(isset($data) ? $data : '') }}"
    :top-url="{{ json_encode(route('home')) }}"
    :sale-management-url="{{ json_encode(route('salesManagement')) }}"
    :date = "{{ json_encode(Carbon\Carbon::now()->format('Y 年 m 月 d 日')) }}"
    :th = "{{ json_encode(App\Enums\DayOffWeek::getThJp(Carbon\Carbon::now()->format('l'))) }}"
    ></daily-report-complete>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
