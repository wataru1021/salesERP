@extends('layouts.admin.auth_base')

@section('content')
    <admin-forgot-password :form-url="{{ json_encode(route('admin.forgot')) }}"
    :form-login="{{ json_encode(route('admin.login')) }}"
        :message="{{ json_encode(isset($message) ? $message : '') }}"
        :message2="{{ json_encode(isset($message2) ? $message2 : '') }}"
        :old-email="{{ json_encode(isset($old_email) ? $old_email : '') }}">
    </admin-forgot-password>
@endsection
