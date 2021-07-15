
@extends('layouts.admin.base')

@section('content')
    <admin-user-list
            :data="{{json_encode([
        'urlGetData' => route('admin.user.getUserlist'),
        'flag-show' => false
    ])}}"
    :register-url="{{json_encode(route('admin.user.getRegister'))}}"
    ></admin-user-list>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection


