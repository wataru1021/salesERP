@extends('layouts.admin.base')

@section('content')
<report-management
:data="{{json_encode([
        'urlGetData' => route('admin.user.getDataReport'),
        'flag-show' => false
    ])}}">
</report-management>
@endsection

@section('javascript')
@endsection