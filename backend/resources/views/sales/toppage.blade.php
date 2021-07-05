@extends('layouts.sales.base')

@section('content')
    <sales-top
        :sales-management-url="{{ json_encode(URL::to('/sales_management')) }}"
    ></sales-top>
@endsection

@section('javascript')

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/main.js') }}" defer></script>
@endsection