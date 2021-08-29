@extends('layouts.sales.base', ['isActiveHeader' => ''])

@section('content')
<sales-appointments
    :data="{{ json_encode(isset($data) ? $data : '') }}"
    :top-url="{{ json_encode(route('home')) }}">
</sales-appointments>
@endsection

@section('javascript')
@endsection