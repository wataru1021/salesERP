@extends('layouts.sales.base', ['isActiveHeader' => ''])

@section('content')
<sales-appointments
    :add-appointment-url="{{ json_encode(route('sales.appointments.getCreate')) }}"
    :data="{{ json_encode(isset($data) ? $data : '') }}">
</sales-appointments>
@endsection

@section('javascript')
@endsection