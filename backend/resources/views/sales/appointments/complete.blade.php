@extends('layouts.sales.base', ['isActiveHeader' => ''])

@section('content')
    <appointments-complete
    :data="{{ json_encode(isset($data) ? $data : '') }}"
    :top-url="{{ json_encode(route('home')) }}"
    :appointments-index-url="{{ json_encode(route('sales.appointments.index')) }}">
    ></appointments-complete>
@endsection

@section('javascript')
@endsection