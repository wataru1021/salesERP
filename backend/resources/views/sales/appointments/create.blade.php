@extends('layouts.sales.base', ['isActiveHeader' => ''])

@section('content')
<sales-appointments-create
    :add-appointment-url="{{ json_encode(route('sales.appointments.getCreate')) }}">
</sales-appointments-create>
@endsection

@section('javascript')
@endsection