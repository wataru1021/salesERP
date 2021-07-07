@extends('layouts.sales.auth_base')

@section('content')
    <sales-change-password :form-url="{{ json_encode(route('resetPassword')) }}"
        :form-login="{{ json_encode(route('login')) }}" :message="{{ json_encode(isset($message) ? $message : '') }}"
        :token="{{ json_encode(isset($token) ? $token : '') }}">
    </sales-change-password>
@endsection
