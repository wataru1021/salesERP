@extends('layouts.sales.auth_base')

@section('content')
    <sales-change-password :form-url="{{ json_encode(route('resetPassword')) }}"
        :form-login="{{ json_encode(route('login')) }}" :form-forgot="{{ json_encode(route('forgot')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :message2="{{ json_encode(isset($message2) ? $message2 : '') }}"
        :token-url="{{ json_encode(isset($tokenUrl) ? $tokenUrl : '') }}">
    </sales-change-password>
@endsection
