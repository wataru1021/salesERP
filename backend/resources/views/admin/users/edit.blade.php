@extends('layouts.admin.base',  ['activeHeader' => 'user-list'])

@section('content')
    <edit-user
            :list-user-url="{{json_encode(route('admin.user.list'))}}"
            :user="{{json_encode($user)}}"
    ></edit-user>
@endsection

@section('javascript')
@endsection
