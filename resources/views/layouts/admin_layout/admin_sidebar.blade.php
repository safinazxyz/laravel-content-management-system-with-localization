<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/admin_img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(empty(Auth::guard('admin')->user()->image))
                    <img src="{{ asset('img/admin_img/admin_constant/admin_constant_photo.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
                @if(!empty(Auth::guard('admin')->user()->image))
                    <img src="{{ asset('img/admin_img/admin_profile/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ ucwords(strtolower(Auth::guard('admin')->user()->name))}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                    @if(Session::get('page')==='dashboard')
                        <?php $active = "active" ?>
                    @else
                        <?php $active = "" ?>
                    @endif
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{trans('admin/sidebar.dashboard')}}
                        </p>
                    </a>
                </li>
                @if(Session::get('page')==='settings' ||
                    Session::get('page')==='update-admin-details' ||
                    Session::get('page')==='show-admin-user-list')
                    <?php $active = "active" ?>
                    <?php $menu = "menu-open" ?>
                @else
                    <?php $active = "" ?>
                    <?php $menu = "" ?>
                @endif
                <li class="nav-item has-treeview {{ $menu }}">
                    <a href="{{ route('admin.settings') }}" class="nav-link {{ $active  }}">
                        <i class="fas fa-user-cog"></i>
                        <p>
                            {{trans('admin/sidebar.settings.settings')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('page')==='settings')
                            <?php $active = "active" ?>
                        @else
                            <?php $active = "" ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('admin.settings') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{trans('admin/sidebar.settings.updateAdminPassword')}}</p>
                            </a>
                        </li>
                            @if(Session::get('page')==='update-admin-details')
                                <?php $active = "active" ?>
                            @else
                                <?php $active = "" ?>
                            @endif
                        <li class="nav-item">
                            <a href="{{ route('admin.admin.details') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{trans('admin/sidebar.settings.updateAdminDetails')}}</p>
                            </a>
                        </li>
                            @if(strtolower(Auth::guard('admin')->user()->type)==='admin')
                                @if(Session::get('page')==='show-admin-user-list')
                                    <?php $active = "active" ?>
                                @else
                                    <?php $active = "" ?>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('admin.admin.users.list') }}" class="nav-link {{ $active }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{trans('admin/sidebar.settings.updateUsersList')}}</p>
                                    </a>
                                </li>
                            @endif
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
