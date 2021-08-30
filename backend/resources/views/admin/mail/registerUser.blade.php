@extends('layouts.admin.auth_base')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">your account has been created</div>
                    <div class="card-body">
                        login with password : {{$password}} pls
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
