@extends('layouts.sales.base')

@section('content')
<sales-report-histories 
    :data="{{ json_encode(isset($saleDailyReport) ? $saleDailyReport : '') }}">
</sales-report-histories>
@endsection

@section('javascript')
@endsection