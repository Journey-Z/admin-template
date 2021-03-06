@extends('Dashboard::layouts.default')
@section('title')
    {{trans('Dashboard::common.system_name')}}
@endsection
@section('css')
{{-- <link href="{{elixir('assets/css/sms_product_review.min.css')}}" rel="stylesheet" /> --}}
@endsection
@section('content')
    <style type="text/css">
      .wrapper{
        height:auto !important;
      }
      .a-btn{margin-bottom: 5px;}
    </style>
    <section class="content-header">
        <h1>{{ trans('Auth::auth.permission_list') }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-sign-in"></i>{{ trans('Auth::auth.permission_management') }}</a></li>
            <li class="active">{{ trans('Auth::auth.permission_list') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div id="searchbar_div" class="box-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <form>
                                        <div class="form-group">
                                            <div class="col-md-3 col-sm-12">
                                                <input type="text" name="search_value" class="form-control" placeholder="{{trans('Auth::auth.permission_display')}}" value="{{old('search_value')}}"/>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <select name="status" class="select2 form-control">
                                                    <option value="">{{ trans('Dashboard::common.choose_status') }}</option>
                                                    @foreach($allStatus as $key => $val)
                                                        <option value="{{$key}}" @if($key == old('status')) selected @endif>{{ trans('Dashboard::common.' . $val)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <button type="submit" class="btn btn-primary keyup_btn">{{ trans('Dashboard::common.submit') }} <i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-3 text-right">
                                <a href="{{route('permission.create')}}" data-target="#add_permission" data-toggle="modal">
                                        <div class="btn btn-primary" id="addCategoryButton">
                                            <i class="fa fa-plus"></i> &nbsp; {{trans('Auth::auth.add_permission')}}
                                        </div>
                                    </a>
                                </div>
                            </div>
                    </div>

                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover darkborder-table">
                                        <tbody>
                                        <tr role="row">
                                            <th class="no-sort">ID</th>
                                            <th class="no-sort">{{ trans('Auth::auth.permission_name') }}</th>
                                            <th class="no-sort">{{ trans('Auth::auth.permission_display') }}</th>
                                            <th class="no-sort">{{ trans('Auth::auth.permission_description') }}</th>
                                            <th data-hide="">{{ trans('Dashboard::common.status') }}</th>
                                            <th class="no-sort">{{ trans('Auth::auth.action') }}</th>
                                        </tr>
                                        @foreach($permissions as $permission)
                                        <tr role="row">
                                          <td>{{$permission->id}}</td>
                                          <td>{{$permission->name}}</td>
                                          <td>{{$permission->display_name}}</td>
                                          <td>{{$permission->description}}</td>
                                          <td>{{trans('Dashboard::common.' . $allStatus[$permission->status])}}</td>
                                          <td>
                                              <a href="{{route('permission.edit', ['id' => $permission->id])}}" class="btn a-btn btn-primary btn-circle edit_permission" data-target="#edit_permission" data-toggle="modal">
                                                    <i class="fa fa-edit"></i> {{ trans('Dashboard::common.edit') }}
                                              </a><br>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    {{$permissions->appends(Request::all())->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <div class="modal fade" id="add_permission"  data-backdrop="static" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
           </div>
       </div>
   </div>

    <div class="modal fade" id="edit_permission"  data-backdrop="static" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div class="modal fade" id="set_password"  data-backdrop="static" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>

@endsection
@section("scripts")
<script>
    $("#edit_permission").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
        $(this).find(".modal-content").children().remove();
    });
    $("#add_permission").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
        $(this).find(".modal-content").children().remove();
    });
</script>
@endsection
