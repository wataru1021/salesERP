@extends('layouts.sales.base',  ['isActiveHeader' => 'sales-login-change-password'])

@section('content')
    <sales-login-change-password
            :top-url="{{json_encode(route('home'))}}"
            :form-Url="{{json_encode(route('sales.changePassword.update'))}}"
    ></sales-login-change-password>
@endsection

@section('javascript')
@endsection
