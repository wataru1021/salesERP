@extends('layouts.admin.base', ['activeHeader' => 'reportManager'])

@section('content')
    <admin-appointments
        :user-response = "{{ json_encode(isset($userResponse) ? $userResponse : '') }}"
    ></admin-appointments>
    
@endsection

@section('javascript')
@endsection