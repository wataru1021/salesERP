@extends('layouts.sales.auth_base')

@section('content')
    <sales-register
            :form-url="{{ json_encode(route('register.post')) }}"
            :login-url="{{ json_encode(route('login')) }}"
            :message="{{ json_encode(isset($message) ? $message : '') }}"
    ></sales-register>
@endsection
