@extends('layouts.admin.auth_base')

@section('content')
    <admin-login
        :form-url="{{ json_encode(route('admin.login')) }}"
        :forgot-password-url="{{ json_encode(route('admin.forgot')) }}"
        :login-id="{{ json_encode(Request::get('login_id')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
    ></admin-login>
@endsection