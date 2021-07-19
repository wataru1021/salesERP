@extends('layouts.sales.auth_base', ['activeHeader' => 'user-list'])

@section('content')
    <sales-register
            :form-url="{{ json_encode(route('register.post')) }}"
            :login-url="{{ json_encode(route('login')) }}"
            :message="{{ json_encode(isset($message) ? $message : '') }}"
            :message-email="{{ json_encode(isset($messageEmail) ? $messageEmail : '') }}"
            :name-user="{{ json_encode(isset($name) ? $name : '') }}"
            :email-user="{{ json_encode(isset($email) ? $email : '') }}"
            :password-user="{{ json_encode(isset($password) ? $password : '') }}"
    ></sales-register>

@endsection
