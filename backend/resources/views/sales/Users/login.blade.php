@extends('layouts.sales.auth_base')

@section('content')
    <sales-login
        :form-url="{{ json_encode(route('login')) }}"
        :forgot-password-url="{{ json_encode(route('forgot')) }}"
        :login-id="{{ json_encode(Request::get('login_id')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
    ></sales-login>
@endsection