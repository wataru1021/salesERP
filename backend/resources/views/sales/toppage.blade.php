@extends('layouts.sales.base', ['isActiveHeader' => 'top'])

@section('content')
    <sales-top
        :sales-management-url="{{ json_encode(route('salesManagement')) }}"
        :appointments-url="{{ json_encode(route('sales.appointments.index')) }}"
        :add-appointment-url="{{ json_encode(route('sales.appointments.getCreate')) }}"
    ></sales-top>
@endsection

@section('javascript')
@endsection