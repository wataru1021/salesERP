@extends('layouts.admin.auth_base')

@section('content')
    <admin-success-password :form-login="{{ json_encode(route('admin.login')) }}"></admin-success-password>
@endsection
