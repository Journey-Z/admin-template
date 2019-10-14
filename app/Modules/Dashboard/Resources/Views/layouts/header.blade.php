<?php
$user=Auth::user();
if($user){
    $email = $user->email;
    $user_name = $user->name;
    $created_at = $user->created_at;
}else{
    $email = '';
    $user_name='no login';
    $created_at_sp='';
}
?>
<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">PDesk</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      <b>PatPat Desk</b>
      <small>
      </small>
    </span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">

    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-language"> @if (App::isLocale('en')){{'English'}}@else{{'简体中文'}}@endif</i>
          </a>
          <ul class="dropdown-menu">
            <li class="header">{{trans('Dashboard::common.language_choose')}}</li>
            <li>
              <ul class="menu" style="height: auto;">
                <li>
                  <a href="/dashboard/change_local?lang=chs">
                    <i class="fa fa-flag text-aqua"></i> 简体中文
                  </a>
                </li>
                <li>
                  <a href="/dashboard/change_local?lang=en">
                    <i class="fa fa-flag-o text-aqua"></i> English
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        {{--Timezone Settings--}}
        @inject('TimeZonePresenter','App\Modules\Dashboard\Presenters\TimeZonePresenter')
        <li class="dropdown dropdown-user">
          <a class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
            <span class="hidden-xs">{{trans('Dashboard::common.timezone')}}：{{$TimeZonePresenter->user_TimeZone()}} </span>
          </a>
        </li>

        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{asset("/assets/img/user_logo.jpg") }}" class="user-image" alt="User Image"/>
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{$user_name}}</span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{asset("/assets/img/user_logo.jpg") }}" class="img-circle" alt="User Image" />
              <p>
                {{$user_name}}
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">

              <!-- 选择时区的options -->
              {{--<div class="pull-left">}}
              {{--{!!Timezone::selectForm('Asia/Hong_Kong','Select a timezone',['class'=>'form-control select2 select2-hidden-accessible','style'=>'width:100%;','tabindex'=>'-1','aria-hidden'=>'true'])!!}--}}
              {{--</div>--}}

              <div class="pull-left">
                  <a href="javascript:void(0)" class="btn btn-default btn-flat" onclick="editUserInfo('{{$email}}')">{{trans('个人信息')}}</a>
              </div>

              <div class="pull-right">
                  <a href="/auth/logout" class="btn btn-default btn-flat"  onclick="return confirm('确定要退出吗?')">退出系统</a>
              </div>
            </li>
          </ul>
        </li>

        <!-- Control Sidebar Toggle Button -->
        {{--<li>--}}
        {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
        {{--</li>--}}

      </ul>
    </div>
  </nav>
</header>

<script type="text/javascript">

    //编辑用户信息
    function editUserInfo(email)
    {
        layer.open({
            type: 2,
            area: ['600px','600px'],
            fix: false, //不固定
            maxmin: false,
            shade:0.4,
            title: '{{trans('编辑个人信息')}}',
            content: '{{url('/user/edit')}}?email='+email,
        });
    }

</script>