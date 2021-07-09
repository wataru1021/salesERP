@extends('layouts.admin.auth_base')

@section('content')
    <admin-forgot-password :form-url="{{ json_encode(route('admin.forgot')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}">
    <admin-forgot-password>
@endsection