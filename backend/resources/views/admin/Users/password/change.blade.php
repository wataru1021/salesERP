@extends('layouts.admin.auth_base')

@section('content')
    <admin-change-password :form-url="{{ json_encode(route('admin.resetPassword')) }}"
        :form-login="{{ json_encode(route('admin.login')) }}" :message="{{ json_encode(isset($message) ? $message : '') }}"
        :token="{{ json_encode(isset($token) ? $token : '') }}">
    </admin-change-password>
@endsection
