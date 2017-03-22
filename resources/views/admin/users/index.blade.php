@extends('admin.master.master')
@section('content')
    <div class="search-m">
        <form action="{{ url('admin/users/index') }}"method="get">
           <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 380px;">
               <span class="selection">
                   <span class="select2-selection select2-selection--single" role="combobox"
                         aria-haspopup="true" aria-expanded="false" tabindex="0"
                         aria-labelledby="select2-g6qg-container"><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
            <input type="text" name="q" placeholder="نام، ایمیل و یا نام کاربری کاربر را وارد کنید..."  value="{{ str_replace('%20',' ',Request::get('q')) }}">
            <input type="submit" value="Search">
        </form>
    </div>
    @foreach($users as $user)
        <div class="col-lg-4">
            <!--widget start-->
            <aside class="profile-nav alt green-border">
                <section class="panel">
                    <div class="user-heading alt green-bg">
                        <a href="#">
                            <img alt="" src="img/profile-avatar.jpg">
                        </a>
                        <h1>{{$user->firstName . ' ' . $user->lastName}}</h1>
                        <p>{{$user->_email}}</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li><a data-toggle="modal" data-target="#permissionModal" data-remote="false"  href="{{url('admin/users/show', $user->id)}}"><i class="icon-calendar"></i>اطلاعات پروفایل کاربر<span
                                        class="label label-info pull-right r-activity">11</span></a></li>
                        <li><a data-toggle="modal" data-target="#permissionModal" data-remote="false"
                               href="{{url('admin/users/permissions', $user->id)}}"><i class="icon-eye-open"></i>دسترسی ها <span
                                        class="label label-primary pull-right r-activity">{{count($user->_permissions)}}</span></a></li>
                        <li><a data-toggle="modal" data-target="#permissionModal" data-remote="false"
                               href="{{url('admin/users/bidded', $user->id)}}"><i class="icon-bell-alt"></i>پیشنهادها <span
                                        class="label label-warning pull-right r-activity">03</span></a></li>
                        <li><a href="javascript:;"><i class="icon-envelope-alt"></i>Message <span
                                        class="label label-success pull-right r-activity">10</span></a></li>
                    </ul>

                </section>
            </aside>
            <!--widget end-->

        </div>

        <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Modal Tittle</h4>
                    </div>
                    <div class="modal-body">
                        <img src="{{ url('asset/img/Loading_icon.gif') }}" width="150" height="100">


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{$users->links()}}
@endsection

@section('js')
<script>
    $("#permissionModal").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-body").load(link.attr("href"));
    });
    $('#permissionModal').on('hidden.bs.modal', function (e) {
        $(this).find(".modal-body").html('<img src="{{ url('asset/img/Loading_icon.gif') }}" width="150" height="100">');
    });

</script>
@endsection