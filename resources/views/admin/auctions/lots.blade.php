@if($lots)
    <div class="row" id="FirstRow">
        <div class="col-lg-12" >
            <section class="panel">
                <header class="panel-heading">
                    لیست کالا ها

                </header>
                <table class="table table-striped border-top" >
                    <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th class="hidden-phone">توضیح</th>
                        <th class="hidden-phone">وضعیت</th>
                        <th class="hidden-phone">قیمت</th>
                        <th class="hidden-phone">نوع</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lots as $lot)
                        <tr class="odd gradeX" id="{{$lot['_id']}}">
                            <td><img src="{{ url($lot['media']['image']['mediaPath'])}}" height="50" width="50"></td>
                            <td>{{ $lot['title']['fa'] }}</td>
                            <td class="hidden-phone" style="">{{ $lot['description']['fa'] }}</td>
                            <td class="hidden-phone"><span class="label label-success">@if($lot['_id'] == $auction->currentLotId)در حال چوب زدن @else {{ $lot['status'] }} @endif</span></td>
                            <td class="hidden-phone">{{ $lot['type'] }}</td>
                            {{--@if(isset($lot['bids']))--}}
                            {{--@foreach($lot['bids'] as $bid)--}}
                            {{--<td class="hidden-phone">{{ $bid['bidder']['user']['userId'] }}</td>--}}
                            {{--@endforeach--}}
                            {{--@endif--}}
                            <td class="hidden-phone">
                                <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                <a href="{{url('admin/lots/edit', $lot['_id'])}}" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></a>
                                <button class="btn btn-danger btn-xs" onclick="deleteLot('{{ $lot['_id'] }}')"><i class="icon-trash "></i></button>
                                <button class="btn btn-info btn-xs" onclick="lotBids('{{$lot['auctionId']}}', '{{ $lot['_id'] }}')"><i class="icon-money"></i></button>
                                <button class="btn btn-info btn-xs" onclick="lotBidders('{{$lot['auctionId']}}', '{{ $lot['_id'] }}')"><i class="icon-user"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$lots->links()}}
            </section>
        </div>
    </div>


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
                $('#FirstRow').html(response);
//                $('#alert').html('کالای مورد نظر با موفقیت حذف شد');
//                $('#alert').css('display','block');
            },
        });
    }
</script>

<script type="text/javascript">
    function lotBidders(auction_id,lot_id) {
        $.ajax({
            url: '{{url('admin/lots/bidders')}}',
            data: {
                _token: '{{csrf_token()}}',
                auctionId: auction_id,
                lotId: lot_id
            },
            type: 'post',
            success: function (response) {
                $('#FirstRow').html(response);
//                $('#alert').html('کالای مورد نظر با موفقیت حذف شد');
//                $('#alert').css('display','block');
            },
        });
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