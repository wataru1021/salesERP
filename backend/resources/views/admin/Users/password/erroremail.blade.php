@extends('layouts.admin.auth_base')

@section('content')
    <admin-error-email :form-login="{{ json_encode(route('admin.login')) }}">
    ></admin-error-email>
@endsection
