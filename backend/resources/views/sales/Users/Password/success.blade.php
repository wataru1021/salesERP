@extends('layouts.sales.auth_base')

@section('content')
    <sales-success-password :form-login="{{ json_encode(route('login')) }}"></sales-success-password>
@endsection
