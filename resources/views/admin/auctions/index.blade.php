@extends('admin.master.master')
@section('content')
    @foreach($data['auctions'] as $auction)
        <div class="col-lg-6">
            <!--widget start-->

            <section class="panel">
                <div class="panel-body">
                    <div class="tab-content tasi-tab">
                        <div class="tab-pane active" id="fa">
                            <aside class="profile-nav alt green-border">
                                <section class="panel">
                                    <div class="user-heading alt green-bg">
                                        <a href="#">
                                            <img src="{{ url($auction->media['image']['mediaPath'])}}" height="50"
                                                 width="50">
                                        </a>
                                        <h1>{{ $auction->title['fa'] }}</h1>
                                        <p>{{ $auction->description['fa'] }}</p>
                                        <p>{{ $auction->country['country']['title']['fa'] }}</p>
                                        <hr/>
                                        <p class="pull-right" style="border-left: 1px solid; margin-left:10px;padding-left:10px">صاحب حراج{{ $auction['owner']['user']['firstName'] }}</p>
                                        <p class="pull-right" style="margin-left:10px;padding-left:10px">سازنده حراج{{ $auction['creator']['user']['firstName'] }}</p>
                                        <p style="margin-left:10px;padding-left:10px">مدیر حراج{{ $auction['manager']['user']['firstName'] }}</p>

                                        <hr/>
                                        <p class="pull-right"
                                           style="border-left: 1px solid; margin-left:10px;padding-left:10px">دسته
                                            بندی: {{ $auction->category['category']['title']['fa'] }}</p>
                                        <p class="pull-right"
                                           style="border-left: 1px solid; margin-left:10px;padding-left:10px">نوع
                                            : {{ $auction->type }}</p>
                                        <p class="pull-right"
                                           style="border-left: 1px solid; margin-left:10px;padding-left:10px">نوع پیشنهاد قیمت : {{ $auction->type }}</p>
                                        <p>نرخ: {{ $auction->bidType }}</p>
                                        <p class="pull-right"
                                           style="border-left: 1px solid; margin-left:10px;padding-left:10px">نوع پذیرش پیشنهاد : {{ $auction->type }}</p>
                                        <p>نرخ: {{ $auction->bidAcceptance }}</p>

                                    </div>

                                    <ul class="nav nav-pills nav-stacked">
                                        <li class="rtl" style="direction: rtl"><a href="javascript:;"><i
                                                        class="icon-time"></i>تاریخ از {{$auction->startAt}} تا
                                                تاریخ {{ $auction->finishAt }}
                                                {{--<span--}}
                                                {{--class="label label-primary pull-right r-activity">19</span>--}}
                                            </a>
                                        </li>

                                        <li><a data-toggle="modal" data-target="#Modal" data-remote="false"
                                               href="{{url('admin/auctions/bidrules', $auction->id)}}"><i
                                                        class="icon-calendar"></i>قوانین پیشنهاد قیمت
                                                {{--<span--}}
                                                {{--class="label label-info pull-right r-activity">11</span>--}}
                                            </a>
                                        </li>

                                        <li><a data-toggle="modal" data-target="#Modal" data-remote="false"
                                               href="{{url('admin/auctions/lots', $auction->id)}}"><i
                                                        class="icon-envelope-alt"></i>کالاها <span
                                                        class="label label-info pull-right r-activity">{{$auction->lotsCount}}</span></a>
                                        </li>
                                        <li><a data-toggle="modal" data-target="#Modal" data-remote="false"
                                               href="{{url('admin/auctions/currentlot', $auction->id)}}"><i
                                                        class="icon-envelope-alt"></i>کالای در حال چوب زدن </a>
                                        </li>
                                        <li><a data-toggle="modal" data-target="#Modal" data-remote="false"
                                               href="{{url('admin/auctions/sold', $auction->id)}}"><i
                                                        class="icon-envelope-alt"></i>کالای فروخته شده
                                                {{--<span--}}
                                                {{--class="label label-info pull-right r-activity">{{$auction->lotsCount}}</span>--}}
                                            </a>
                                        </li>
                                        <li><a data-toggle="modal" data-target="#Modal" data-remote="false"
                                               href="{{url('admin/auctions/bidded', $auction->id)}}"><i
                                                        class="icon-envelope-alt"></i>کاربرانی که در حراج شرکت کرده اند </a>
                                        </li>
                                        <li>
                                            <p style="text-align: left">
                                                <a href="{{url('admin/auctions/publish', $auction->id)}}" class="btn btn-success btn-xs"><i class="icon-exchange"></i></a>
                                                <a href="{{url('admin/auctions/edit', $auction->_id)}}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                                <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                                <a data-toggle="modal" data-target="#Modal" data-remote="false"
                                                   href="{{url('admin/auctions/admin/add', $auction->id)}}" class="btn btn-xs btn-warning btn-xs"><i class="icon-user"></i></a>
                                                <a data-toggle="modal" data-target="#Modal" data-remote="false"
                                                   href="{{URL::route('lots.index', array('auction_id' => $auction->id))}}"
                                                    class="btn btn-xs btn-primary btn-xs"><i class="icon-plus"></i></a>
                                            </p>
                                        </li>
                                    </ul>

                                </section>
                            </aside>
                        </div>


                    </div>
                </div>
            </section>
            <!--widget end-->
        </div>

    @endforeach
    {{--<div class="row">--}}
    {{--<div class="col-lg-12">--}}
    {{--<section class="panel">--}}
    {{--<header class="panel-heading">--}}
    {{--Dynamic Table--}}

    {{--</header>--}}
    {{--<table class="table table-striped border-top" id="sample_1">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th style="width: 8px;">--}}
    {{--<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>--}}
    {{--<th>تصویر</th>--}}
    {{--<th>عنوان</th>--}}
    {{--<th class="hidden-phone">توضیح</th>--}}
    {{--<th class="hidden-phone">صاحب حراجی</th>--}}
    {{--<th class="hidden-phone">دسته بندی</th>--}}
    {{--<th class="hidden-phone"></th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($data['auctions'] as $auction)--}}

    {{--<tr class="odd gradeX">--}}
    {{--<td>--}}
    {{--<input type="checkbox" class="checkboxes" value="1"/></td>--}}
    {{--<td><img src="{{ url($auction->media['image']['mediaPath'])}}" height="50" width="50"></td>--}}
    {{--<td>{{ $auction->title['fa'] }}</td>--}}
    {{--<td class="hidden-phone" style=""><a--}}
    {{--href="mailto:jhone-doe@gmail.com">{{ $auction->description['fa'] }}</a></td>--}}
    {{--<td class="hidden-phone">{{ $auction->category['category']['title']['fa'] }}</td>--}}
    {{--                    <td class="center hidden-phone">{{ $auction->title['fa'] }}</td>--}}
    {{--<td class="hidden-phone">--}}
    {{--<button class="btn btn-danger">حذف</button>--}}
    {{--</td>--}}
    {{--<td>--}}
    {{--<button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>--}}
    {{--<a href="{{url('admin/auctions/edit', $auction->_id)}}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>--}}
    {{--<button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</section>--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none">
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
@endsection

@section('js')
    <script>
        $("#Modal").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget);
            $(this).find(".modal-body").load(link.attr("href"));
        });
        $('#Modal').on('hidden.bs.modal', function (e) {
            $(this).find(".modal-body").html('<img src="{{ url('asset/img/Loading_icon.gif') }}" width="150" height="100">');
        });

    </script>
@endsection