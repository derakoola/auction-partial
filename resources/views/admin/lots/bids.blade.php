<div class="row" id="FirstRow">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <button class="btn btn-success" style="text-align: left" id="previous-page">بازگشت</button>
            </div>
            {{--<div class="col-lg-6">--}}
                {{--<form id="searchBidders" >--}}
           {{--<span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 380px;">--}}
               {{--<span class="selection">--}}
                   {{--<span class="select2-selection select2-selection--single" role="combobox"--}}
                         {{--aria-haspopup="true" aria-expanded="false" tabindex="0"--}}
                         {{--aria-labelledby="select2-g6qg-container"><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>--}}
                    {{--<input class="form-control" type="text" name="q" placeholder="نام، ایمیل و یا نام کاربری پیشنهاد دهنده..."  value="{{ str_replace('%20',' ',Request::get('q')) }}">--}}
                {{--</form>--}}
            {{--</div>--}}
        </div>

        <section class="panel">
            <header class="panel-heading">
                لیست پیشنهاد ها

            </header>
            <table class="table table-striped border-top" id="sample_1">
                @if(isset($bids))
                <thead>
                <tr>
                    <th>ترتیب</th>
                    <th>قیمت به دلار</th>
                    <th>قیمت به ریال</th>
                    <th>قیمت به تومان</th>
                    <th>پیشنهاد دهنده</th>
                    <th>نماش اطلاعات</th>
                    <th>پذیرفته شده</th>
                    <th>تاریخ پیشنهاد</th>
                </tr>
                </thead>
                <tbody>

                @foreach($bids as $bid)
                        <td class="hidden-phone" style="">{{$bid['_order'] }}</td>
                        <td class="hidden-phone" style="">{{$bid['prices']['usd'] }}</td>
                        <td class="hidden-phone" style="">{{$bid['prices']['irr'] }}</td>
                        <td class="hidden-phone" style="">{{$bid['prices']['toman'] }}</td>
                        <td class="hidden-phone" style="">{{$bid['bidder']['user']['firstName'] }}</td>
                        <td class="hidden-phone" style="">
                            @if($bid['showBidderIdentity'] == '1') بله @else خیر @endif</td>
                        <td class="hidden-phone" style="">{{$bid['bidAccepted'] }}</td>
                        <td class="hidden-phone" style="">{{$bid['bidAt'] }}</td>

                    </tr>
                @endforeach
                {{$bids->links()}}
                    @else
                <td>پیشنهادی برای این قطعه وجود ندارد</td>
                    @endif
                </tbody>
            </table>
        </section>
    </div>
</div>
<script>
    $('#previous-page').click(function () {
        $.ajax({
            url: '{{url('admin/auctions/lots', $auctionId)}}',
            type: 'get',
            success: function (response) {
                $('#FirstRow').html(response);

            },
        });
    })
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