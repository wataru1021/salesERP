@extends('layouts.sales.auth_base')

@section('content')
    <sales-login
        :form-url="{{ json_encode(route('login')) }}"
        :forgot-password-url="{{ json_encode(route('forgot')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :old-email="{{ json_encode(isset($old_email) ? $old_email : '') }}"
        :old-password="{{ json_encode(isset($old_password) ? $old_password : '') }}"
    ></sales-login>
@endsection