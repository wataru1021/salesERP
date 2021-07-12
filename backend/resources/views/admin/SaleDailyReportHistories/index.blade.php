@extends('layouts.admin.base')

@section('content')
    <sale-daily-report-histories
    :url-get-data="{{ json_encode(route('admin.saleReportHistory.getData')) }}"
    :user-response = "{{ json_encode(isset($userResponse) ? $userResponse : '') }}"
    ></sale-daily-report-histories>
    
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
