@extends('layouts.sales.auth_base')

@section('content')
    <sales-error-email :form-login="{{ json_encode(route('login')) }}"
    :message2="{{ json_encode(isset($message2) ? $message2 : '') }}">
    ></sales-error-email>
@endsection