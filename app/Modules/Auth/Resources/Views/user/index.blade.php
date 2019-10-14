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
        <h1>{{ trans('Auth::auth.user_list') }}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-sign-in"></i>{{ trans('Auth::auth.user_management') }}</a></li>
            <li class="active">{{ trans('Auth::auth.user_list') }}</li>
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
                                                <select name="search_type" class="select2 form-control">
                                                    <option value="name" {{old('search_type') == 'name' ? 'selected' : ''}}>{{ trans('Auth::auth.username') }}</option>
                                                    <option value="email" {{old('search_type') == 'email' ? 'selected' : ''}}>{{ trans('Auth::auth.email') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <input type="text" name="search_value" class="form-control" placeholder="{{ trans('Dashboard::common.search_content') }}" value="{{old('search_value')}}"/>
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
                                <a href="{{route('user.create')}}" data-target="#add_user" data-toggle="modal">
                                        <div class="btn btn-primary" id="addCategoryButton">
                                            <i class="fa fa-plus"></i> &nbsp; {{trans('Auth::auth.add_user')}}
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
                                            <th class="no-sort">{{ trans('Auth::auth.username') }}</th>
                                            <th class="no-sort">{{ trans('Auth::auth.email') }}</th>
                                            <th class="no-sort">{{ trans('Auth::auth.role') }}</th>
                                            <th data-hide="注册时间">{{ trans('Auth::auth.register_date') }}</th>
                                            <th data-hide="最后登录时间">{{ trans('Auth::auth.last_login_time') }}</th>
                                            <th data-hide="">{{ trans('Dashboard::common.status') }}</th>
                                            <th class="no-sort">{{ trans('Auth::auth.action') }}</th>
                                        </tr>
                                        @foreach($users as $user)
                                        <tr role="row">
                                          <td>{{$user->id}}</td>
                                          <td>{{$user->name}}</td>
                                          <td>{{$user->email}}</td>
                                          <td>
                                            @foreach ($user->roles()->pluck('display_name') as $role)
                                                <span class="label label-info label-many">{{ $role }}</span>
                                            @endforeach
                                          </td>
                                          <td>{{$user->created_at}}</td>
                                          <td>{{$user->updated_at}}</td>
                                          <td>{{trans('Dashboard::common.' . $allStatus[$user->status])}}</td>
                                          <td>
                                              <a href="{{route('user.edit', ['id' => $user->id])}}" class="btn a-btn btn-primary btn-circle edit_user" data-target="#edit_user" data-toggle="modal">
                                                    <i class="fa fa-edit"></i> {{ trans('Dashboard::common.edit') }}
                                              </a><br>
                                              {{-- <a href="#" class="btn a-btn btn-warning btn-circle set_password" data-target="#set_password" data-toggle="modal">
                                                  <i class="fa fa-edit"></i> {{ trans('Auth::auth.reset_password') }}
                                              </a><br> --}}
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    {{$users->appends(Request::all())->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <div class="modal fade" id="add_user"  data-backdrop="static" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
           </div>
       </div>
   </div>

    <div class="modal fade" id="edit_user"  data-backdrop="static" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myModalLabel">
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
    $("#edit_user").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
        $(this).find(".modal-content").children().remove();
    });
    $("#add_user").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
        $(this).find(".modal-content").children().remove();
    });
    $("#set_password").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
        $(this).find(".modal-content").children().remove();
    });
    $('.unlock_user').on('click', function () {
        var _this = $(this);
        _this.attr('disabled', true);
        $.ajax({
            url: _this.attr('href'),
            method:"post",
            data: {},
            success: function (data) {
                if (data.status == 200) {
                    toastr.success('用户解锁成功');
                    window.location.reload();
                } else {
                    toastr.warning("", "用户解锁失败");
                    _this.attr('disabled', false);
                }
            }
        });
        return false;
    })
</script>
@endsection
