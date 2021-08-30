@extends('layouts.sales.base', ['isActiveHeader' => 'sales-login-change-password'])

@section('content')
    <sales-login-change-password-error
            :top-url="{{ json_encode(route('home')) }}"
    ></sales-login-change-password-error>
@endsection
