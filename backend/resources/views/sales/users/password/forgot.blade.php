@extends('layouts.sales.auth_base')

@section('content')
    <sales-forgot-password :form-url="{{ json_encode(route('forgot')) }}"
        :form-login="{{ json_encode(route('login')) }}" 
        :form-register="{{ json_encode(route('register')) }}" 
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :message2="{{ json_encode(isset($message2) ? $message2 : '') }}"
        :old-email="{{ json_encode(isset($old_email) ? $old_email : '') }}">
    </sales-forgot-password>
@endsection
