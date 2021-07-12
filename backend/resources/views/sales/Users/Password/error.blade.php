@extends('layouts.sales.auth_base')

@section('content')
    <sales-error-password :form-login="{{ json_encode(route('login')) }}"></sales-error-password>
@endsection

