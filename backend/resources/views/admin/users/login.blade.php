@extends('layouts.admin.auth_base')

@section('content')
    <admin-login
        :form-url="{{ json_encode(route('admin.login')) }}"
        :forgot-password-url="{{ json_encode(route('admin.forgot')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :old-email="{{ json_encode(isset($old_email) ? $old_email : '') }}"
        :old-password="{{ json_encode(isset($old_password) ? $old_password : '') }}"
    ></admin-login>
@endsection