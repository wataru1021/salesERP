@extends('layouts.admin.base', ['activeHeader' => 'reportManager'])

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