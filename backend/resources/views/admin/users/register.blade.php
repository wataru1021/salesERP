
@extends('layouts.admin.base')

@section('content')
<register-user
:list-user-url="{{json_encode(route('admin.user.list'))}}"
></register-user>
@endsection

@section('javascript')
@endsection


