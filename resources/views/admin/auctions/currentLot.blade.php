@if(isset($currentLot))
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
                        <tr class="odd gradeX" id="{{$currentLot['_id']}}">
                            <td><img src="{{ url($currentLot['media']['image']['mediaPath'])}}" height="50" width="50"></td>
                            <td>{{ $currentLot['title']['fa'] }}</td>
                            <td class="hidden-phone" style="">{{ $currentLot['description']['fa'] }}</td>
                            <td class="hidden-phone"><span class="label label-success">{{ number_format($currentLot['hottestBid']) . ' ' . $currentLot['currency']}}</span></td>
                            {{--                            <td class="hidden-phone">{{ $currentLot['price'] }}</td>--}}
                            <td class="hidden-phone">{{ $currentLot['type'] }}</td>
                            {{--                            <td class="hidden-phone">{{ $currentLot['category']['title']['fa'] }}</td>--}}
                            {{--<td>--}}
                            {{--{{ $currentLot['auction['title['fa'] }}--}}
                            {{--</td>--}}
                            <td class="hidden-phone">
                                <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="deleteLot('{{ $currentLot['_id'] }}')"><i class="icon-trash "></i></button>
                                <button class="btn btn-info btn-xs" onclick="lotBids('{{$currentLot['auctionId']}}', '{{ $currentLot['_id'] }}')"><i class="icon-user "></i></button>

                            </td>
                        </tr>

                    </tbody>

                </table>
                {{--                {{$data['lots']->links()}}--}}
            </section>
        </div>
    </div>

    {{--<div class="col-lg-12">--}}
    {{--<section class="panel">--}}
    {{--<header class="panel-heading">--}}
    {{--کالاهای این حراج--}}
    {{--</header>--}}
    {{--<ul class="list-group">--}}
    {{--@foreach($currentLots as $key=>$currentLot)--}}
    {{--<li class="list-group-item"><img src="">{{$currentLot['title']['fa']}}</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}

    {{--</section>--}}
    {{--</div>--}}
@else
    <p>این حراجی هیچ کالایی ندارد</p>
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

<script type="text/javascript">
    function lotBids(auction_id,lot_id) {
        $.ajax({
            url: '{{url('admin/lots/bids')}}',
            data: {
                _token: '{{csrf_token()}}',
                auctionId: auction_id,
                lotId: lot_id
            },
            type: 'post',
            success: function (response) {
                console.log(response);
                $('#FirstRow').html(response);
//                $('#alert').html('کالای مورد نظر با موفقیت حذف شد');
//                $('#alert').css('display','block');
            },
        });
    }
</script>