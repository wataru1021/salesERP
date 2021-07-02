@extends('layouts.admin.auth_base')

@section('content')
    <admin-login
        :form-url="{{ json_encode(route('admin.login')) }}"
        :login-id="{{ json_encode(Request::get('login_id')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
    ></admin-login>
@endsection