@extends('layouts.sales.auth_base')

@section('content')
    <sales-forgot-password :form-url="{{ json_encode(route('forgot')) }}"
        :form-login="{{ json_encode(route('login')) }}" :message="{{ json_encode(isset($message) ? $message : '') }}">
    </sales-forgot-password>
@endsection
