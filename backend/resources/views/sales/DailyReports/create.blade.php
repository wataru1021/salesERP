@extends('layouts.sales.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><strong>2021年12月30日(土)の日報</strong></div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            {{-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">Static</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">Username</p>
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="input1">ピンポン数（訪問件数）</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="input1" type="number" name="text-input" placeholder="333">
                                    {{-- <span class="help-block">This is a help text</span> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="input2">対面数</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="number_ping_pong" type="number" name="text-input" placeholder="80">
                                    {{-- <span class="help-block">This is a help text</span> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="number_ping_pong">ピンポン数（訪問件数）</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="number_ping_pong" type="text" name="text-input" placeholder="Text">
                                    {{-- <span class="help-block">This is a help text</span> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="number_ping_pong">ピンポン数（訪問件数）</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="number_ping_pong" type="text" name="text-input" placeholder="Text">
                                    {{-- <span class="help-block">This is a help text</span> --}}
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="textarea-input">Textarea</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="textarea-input" name="textarea-input" rows="9"
                                        placeholder="Content.."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
                        <button class="btn btn-sm btn-danger" type="reset"> Reset</button>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
@endsection

@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
