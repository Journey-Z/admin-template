<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">{{trans('Auth::auth.add_role')}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="add_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">
                            <span class="red-required">*</span>
                            {{trans('Auth::auth.role_name')}}
                        </label>
                        <div class="col-sm-9 release-input">
                            <input type="text" class="form-control" placeholder="{{trans('Auth::auth.role_name')}}" id="role_name" name="role_name" datatype="s4-18" errormsg="昵称至少4个字符，最多18个字符！" nullmsg="请输入昵称！"/>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">
                            <span class="red-required">*</span>
                            {{trans('Auth::auth.role_display')}}
                        </label>
                        <div class="col-sm-9 release-input">
                            <input type="text" class="form-control"  placeholder="{{trans('Auth::auth.role_display')}}" id="role_display" name="role_display" datatype="e" errormsg="必须是邮箱地址！" nullmsg="请输入邮箱！"/>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">
                            {{trans('Auth::auth.role_description')}}
                        </label>
                        <div class="col-sm-9 release-input">
                            <input type="text" class="form-control"  placeholder="{{trans('Auth::auth.role_description')}}" id="role_description" name="role_description" datatype="*6-18" errormsg="密码范围在6~18位之间！" nullmsg="请输入密码！"/>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">
                            <span class="red-required">*</span>{{ trans('Dashboard::common.status') }}
                        </label>
                        <div class="col-sm-9 release-input">
                            <select class="form-control"  name="status">
                                @foreach($allStatus as $key => $val)
                                    <option value="{{ $key }}">{{ trans('Dashboard::common.' . $val)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-sm-2 control-label">{{ trans('Auth::auth.permission') }}</label>
                        <div class="col-sm-9 release-input select-permissions">
                                <select id="permissions" class="form-control select2 " name="permissions[]" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->name}}">{{$permission->display_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                    </div>       
                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('Dashboard::common.cancel')}}</button>
        <button type="button" class="btn btn-primary save">{{trans('Dashboard::common.save')}}</button>
    </div>
    
    <script>
        $(".save").on("click",function(){
            var data = $("#add_form").serialize();
            var _this = $(this);
            _this.attr('disabled', true);
            $.ajax({
                url: "{{route('role.store')}}",
                method:"post",
                data: data,
                success: function (data) {
                    if (data.status == 200) {
                        toastr.success(data.msg);
                        window.location.reload();
                    } else {
                        toastr.warning(data.msg,data.msg);
                        _this.attr('disabled', false);
                    }
                },
                error: function (err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        console.log(err.responseJSON.errors);
                        $.each(err.responseJSON.errors, function (i, error) {
                            toastr.error(error[0]);
                        });
                    }
                    _this.attr('disabled', false);
                }
            });
        })
    
        $(".select-permissions .select2").select2();
    </script>
    
    
    