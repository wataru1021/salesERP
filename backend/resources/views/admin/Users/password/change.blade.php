@extends('layouts.admin.auth_base')

@section('content')
    <admin-change-password :form-url="{{ json_encode(route('admin.resetPassword')) }}"
        :form-login="{{ json_encode(route('admin.login')) }}" :message="{{ json_encode(isset($message) ? $message : '') }}"
        :token-url="{{ json_encode(isset($tokenUrl) ? $tokenUrl : '') }}">
    </admin-change-password>
@endsection
