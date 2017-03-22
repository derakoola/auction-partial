@if(isset($soldLots))
    <div class="row" id="FirstRow">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    لیست کالا ها

                </header>
                <table class="table table-striped border-top" id="sample_1">
                    <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th class="hidden-phone">توضیح</th>
                        <th class="hidden-phone">آخرین قیمت</th>
                        <th class="hidden-phone">قیمت</th>
                        <th class="hidden-phone">آخرین قیمت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($soldLots as $lot)
                    <tr class="odd gradeX" id="{{$lot['_id']}}">
                        <td><img src="{{ url($lot['media']['image']['mediaPath'])}}" height="50" width="50"></td>
                        <td>{{ $lot['title']['fa'] }}</td>
                        <td class="hidden-phone" style="">{{ $lot['description']['fa'] }}</td>
                        <td class="hidden-phone"><span class="label label-success">{{ number_format($lot['hottestBid']) . ' ' . $lot['currency']}}</span></td>
                        {{--                            <td class="hidden-phone">{{ $lot['price'] }}</td>--}}
                        <td class="hidden-phone">{{ $lot['type'] }}</td>
                        {{--                            <td class="hidden-phone">{{ $lot['category']['title']['fa'] }}</td>--}}
                        {{--<td>--}}
                        {{--{{ $lot['auction['title['fa'] }}--}}
                        {{--</td>--}}
                        <td class="hidden-phone">
                            <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                            <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                            <button class="btn btn-danger btn-xs" onclick="deleteLot('{{ $lot['_id'] }}')"><i class="icon-trash "></i></button>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                                {{$soldLots->links()}}
            </section>
        </div>
    </div>

    {{--<div class="col-lg-12">--}}
    {{--<section class="panel">--}}
    {{--<header class="panel-heading">--}}
    {{--کالاهای این حراج--}}
    {{--</header>--}}
    {{--<ul class="list-group">--}}
    {{--@foreach($lots as $key=>$lot)--}}
    {{--<li class="list-group-item"><img src="">{{$lot['title']['fa']}}</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}

    {{--</section>--}}
    {{--</div>--}}
@else
    <p>این حراجی هیچ کالای فروخته شده ای ندارد</p>
@endif
<script type="text/javascript">
    function deleteLot(lot_id) {
        if (!confirm('آیا میخواهید این کالا را حذف کنید؟')) {
            return false;
        }
        else {
            $.ajax({
                url: '{{url('admin/lots/delete')}}' + '/' + lot_id,
                type: 'get',
                success: function (response) {
                    console.log(response.data);
                    $('#' + lot_id).remove();
                    $('#alert').html('کالای مورد نظر با موفقیت حذف شد');
                    $('#alert').css('display','block');
                },
            });
        }

    }


</script>

<script>

    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        if ( $(this).attr('href') != '#' ) {
            $("html, body").animate({ scrollTop: 0 }, "fast");
            $('#FirstRow').load($(this).attr('href'));
        }
    });
</script>