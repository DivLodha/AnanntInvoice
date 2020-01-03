<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            
            <li class="nav-item start active open">
                <a href="{{url('/administrator')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
            <!-- <li class="nav-item  ">
                <a href="{{admin_url('form/list')}}" class="nav-link nav-toggle">
                    <i class="icon-envelope"></i>
                    <span class="title">Applications</span>
                </a>
            </li> -->
            @if($admin == "Yes")
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Users</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{admin_url('users')}}" class="nav-link ">
                            <span class="title">List of Users</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endif
            <li class="nav-item  ">
                <a href="{{admin_url('customer')}}" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Customer</span>
                    <span class="arrow"></span>
                </a>
                <!-- <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{admin_url('form')}}" class="nav-link ">
                            <span class="title">Form</span>
                        </a>
                    </li>
              </ul> -->
        </li>
        <li class="nav-item  ">
                <a href="{{admin_url('invoice')}}" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Invoices</span>
                    <span class="arrow"></span>
                </a>
                <!-- <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{admin_url('form')}}" class="nav-link ">
                            <span class="title">Form</span>
                        </a>
                    </li>
              </ul> -->
        </li>
        <!-- <li class="nav-item  ">
                <a href="{{admin_url('gre')}}" class="nav-link nav-toggle">
                    <i class="icon-docs"></i>
                    <span class="title">Data</span>
                    <span class="arrow"></span>
                </a>
              <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{admin_url('gre')}}" class="nav-link ">
                            <span class="title">GRE</span>
                        </a>
                    </li>
              </ul>
        </li>
        -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
