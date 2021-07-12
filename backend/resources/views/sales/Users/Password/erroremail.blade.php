@extends('layouts.sales.auth_base')

@section('content')
    <sales-error-email :form-login="{{ json_encode(route('login')) }}">
        ></sales-error-email>
@endsection
