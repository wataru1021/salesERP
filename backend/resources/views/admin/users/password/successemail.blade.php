@extends('layouts.admin.auth_base')

@section('content')
    <admin-success-email :form-login="{{ json_encode(route('admin.login')) }}"></admin-success-email>
@endsection
