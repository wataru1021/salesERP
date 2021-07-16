@extends('layouts.sales.auth_base')

@section('content')
    <sales-success-email :form-login="{{ json_encode(route('login')) }}"></sales-success-email>
@endsection
