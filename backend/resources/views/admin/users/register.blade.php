
@extends('layouts.admin.base',  ['activeHeader' => 'user-list'])

@section('content')
<register-user
:list-user-url="{{json_encode(route('admin.user.list'))}}"
></register-user>
@endsection

@section('javascript')
@endsection


