<div class="row" id="bidsContent">
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <button class="btn btn-success" style="text-align: left" id="previous-page">بازگشت</button>
            </div>

        </div>

        <section class="panel">
            <header class="panel-heading">
                لیست پیشنهاد ها

            </header>
            <table class="table table-striped border-top" id="sample_1">      @if(isset($bidded))
                <thead>
                <tr>
                    <th>ترتیب</th>
                    <th>قیمت به دلار</th>
                    <th>قیمت به ریال</th>
                    <th>قیمت به تومان</th>
                    <th>در حراجی</th>
                    <th>نماش اطلاعات</th>
                    <th>پذیرفته شده</th>
                    <th>تاریخ پیشنهاد</th>
                </tr>
                </thead>
                <tbody>



                        @foreach($bidded as $bid)
<tr>
                            <td class="hidden-phone" style="">{{$bid['_order'] }}</td>
                            <td class="hidden-phone" style="">{{$bid['prices']['usd'] }}</td>
                            <td class="hidden-phone" style="">{{$bid['prices']['irr'] }}</td>
                            <td class="hidden-phone" style="">{{$bid['prices']['toman'] }}</td>
                            <td class="hidden-phone" style="">{{$bid['auction'] }}</td>
                            <td class="hidden-phone" style="">
                                @if($bid['showBidderIdentity'] == '1') بله @else خیر @endif</td>
                            <td class="hidden-phone" style="">{{$bid['bidAccepted'] }}</td>
                            <td class="hidden-phone" style="">{{$bid['bidAt'] }}</td>

                        @endforeach
{{ $bidded->links() }}
</tr>
                    @else
                        <td>این کاربری در هیچ حراجی پیشنهادی نداده است!</td>                        </tr>

                    @endif

                </tbody>
            </table>
        </section>
    </div>
</div>

<script>

    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        if ( $(this).attr('href') != '#' ) {
            $("html, body").animate({ scrollTop: 0 }, "fast");
            $('#bidsContent').load($(this).attr('href'));
        }
    });
</script>