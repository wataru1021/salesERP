@extends('layouts.admin.base')

@section('content')

    <admin-sales-chart-index>

    </admin-sales-chart-index>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection