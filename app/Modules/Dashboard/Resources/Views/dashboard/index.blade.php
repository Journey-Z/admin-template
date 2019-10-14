@extends('Dashboard::layouts.default')
@section('title')
    {{trans('Dashboard::common.system_name')}}
@endsection
@section('css')

<!-- Morris chart -->
<link href="{{ asset("/assets/adminlte/plugins/morris/morris.css")}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <section class="content-header">
        <h1>{{trans('Dashboard::common.dashboard')}}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-table"></i>{{trans('Dashboard::common.home_page')}}</a></li>
            <li class="active" id="hand_click" val="" url="">{{trans('Dashboard::common.dashboard')}}</li>
        </ol>
    </section>
    <section class="content" style="border:0px">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>100</h3>
                        <p>Test</p>
                    </div>
                    <div class="icon">
                        <i class="io ion-android-apps"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        {{trans('Dashboard::common.detail')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Test</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-plane"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    {{trans('Dashboard::common.detail')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Test</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-social-buffer"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    {{trans('Dashboard::common.detail')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Test</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-paw"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                    {{trans('Dashboard::common.detail')}} <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('scripts')
        <!-- Morris.js charts -->
    <script src="{{ asset ("/assets/adminlte/plugins/morris/raphael-min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/assets/adminlte/plugins/morris/morris.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/assets/adminlte/js/demo.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/assets/adminlte/plugins/chartjs/Chart.min.js") }}" type="text/javascript"></script>
    <script>
        $(function () {
           //
        });
    </script>
@endsection

