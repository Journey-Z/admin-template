<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- search form (Optional) -->
    <form action="/dashboard/search" method="POST" class="sidebar-form">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="input-group">
        <input type="text" name="keywords" title="{{trans('Dashboard::common.search_content')}}" class="form-control" placeholder="{{trans('Dashboard::common.search')}}..."/>
        <span class="input-group-btn">
          <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <?php
      $host = \Request::server('HTTP_HOST');
      $host = explode('.', $host);
    ?>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      @foreach($menus as $menu)
        <li class="treeview @if($menu['is_open']) active @endif">
          <a href="#">
            <i class="{{$menu['icon']}}"></i> <span>
              {{ trans('Dashboard::menu.' . $menu['title']) }}
            </span> <i class="fa fa-angle-right pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @foreach($menu['menus'] as $submenu)
              <li @if($submenu['is_active']) class="active" @endif>
                <a @if(isset($submenu['target'])) target="{{$submenu['target']}}" @endif href="{{$submenu['link']}}">
                  <i class="{{$submenu['icon']}}"></i>
                  {{ trans('Dashboard::menu.' . $submenu['title']) }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>
    <!-- /.sidebar-menu -->

  </section>
  <!-- /.sidebar -->
</aside>
<script>

</script>