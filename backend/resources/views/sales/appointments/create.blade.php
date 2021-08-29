@extends('layouts.sales.base', ['isActiveHeader' => ''])

@section('content')
<sales-appointments-create
    :add-appointment-url="{{ json_encode(route('sales.appointments.getCreate')) }}"
    :top-url="{{ json_encode(route('home')) }}"
    :appointments-index-url="{{ json_encode(route('sales.appointments.index')) }}">
</sales-appointments-create>
@endsection

@section('javascript')
@endsection