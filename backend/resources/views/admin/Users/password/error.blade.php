@extends('layouts.admin.auth_base')

@section('content')
    <admin-error-password :form-url="{{ json_encode(route('admin.forgot')) }}"
        :message2="{{ json_encode(isset($message2) ? $message2 : '') }}"></admin-error-password>
@endsection
