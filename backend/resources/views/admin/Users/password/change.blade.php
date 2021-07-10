@extends('layouts.admin.auth_base')

@section('content')
    <admin-change-password :form-url="{{ json_encode(route('admin.resetPassword')) }}"
        :form-login="{{ json_encode(route('admin.login')) }}" :form-forgot="{{ json_encode(route('admin.forgot')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :message2="{{ json_encode(isset($message2) ? $message2 : '') }}"
        :token-url="{{ json_encode(isset($tokenUrl) ? $tokenUrl : '') }}">
    </admin-change-password>
@endsection
