@extends('layouts.admin.auth_base')

@section('content')
    <admin-forgot-password :form-url="{{ json_encode(route('admin.forgot')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :message2="{{ json_encode(isset($message2) ? $message2 : '') }}">
    </admin-forgot-password>
@endsection
