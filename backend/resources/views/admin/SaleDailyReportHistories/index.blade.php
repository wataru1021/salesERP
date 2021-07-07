@extends('layouts.admin.base')

@section('content')
    <sale-daily-report-histories
    :url-get-data="{{ json_encode(route('admin.saleReportHistory.getData')) }}"
    {{-- :start-date = "{{ json_encode(Carbon\Carbon::now()->format('Y年m月d日')) }}"
    :end-date = "{{ json_encode(Carbon\Carbon::now()->format('Y年m月d日')) }}" --}}
    ></sale-daily-report-histories>
    
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
