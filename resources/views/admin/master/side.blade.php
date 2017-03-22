 <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li class="active">
                    <a class="" href="index.html">
                        <i class="icon-dashboard"></i>
                        <span>صفحه اصلی</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon-book"></i>
                        <span>حراجی ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('admin/auctions/index') }}">همه حراجی ها</a></li>
                        <li><a class="" href="{{ url('admin/auctions/hot') }}">حراجی های داغ</a></li>
                        <li><a class="" href="{{ url('admin/auctions/add') }}">افزودن حراجی جدید</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon-cogs"></i>
                        <span>دسته بندی ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('admin/categories/index') }}">لیست دسته بندی ها</a></li>
                        <li><a class="" href="{{ url('admin/categories/add') }}">افزودن دسته بندی ها</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon-tasks"></i>
                        <span>کاربران سایت</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{ url('admin/users/index') }}">لیست کاربران</a></li>
                        <li><a class="" href="{{ url('admin/users/add') }}">افزودن کاربر جدید</a></li>
                        <li><a class="" href="{{ url('admin/users/permissions/index') }}">دسترسی ها</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="">
                        <i class="icon-th"></i>
                        <span>کالاهای سایت</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a class="" href="{{url('admin/lots/index')}}">همه کالاها</a></li>
                        <li><a class="" href="{{url('admin/lots/sold/index')}}">کالاهای فروخته شده</a></li>
                        <li><a class="" href="{{url('admin/lots/add')}}">افزودن کالای جدید</a></li>
                    </ul>
                </li>


            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>