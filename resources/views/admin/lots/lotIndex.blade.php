    <div id="alert" class="alert alert-success" style="display: none;position: fixed;top:0px;left:0px;z-index: 1000000;"> </div>
    <div class="row" id="lotsContent">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    لیست کالا ها

                </header>
                <table class="table table-striped border-top" id="sample_1">
                    <thead>
                    <tr>
                        <th style="width: 8px;">
                            <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/></th>
                        <th>تصویر</th>
                        <th>عنوان</th>
                        <th class="hidden-phone">توضیح</th>
                        <th class="hidden-phone">وضعیت</th>

                        <th class="hidden-phone">قیمت</th>
                        <th class="hidden-phone">نوع</th>
                        <th class="hidden-phone">دسته بندی</th>
                        <th class="hidden-phone">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['lots'] as $lot)
                        <tr class="odd gradeX" id="{{$lot->_id}}">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/></td>
                            <td><img src="{{ url($lot->media['image']['mediaPath'])}}" height="50" width="50"></td>
                            <td>{{ $lot->title['fa'] }}</td>
                            <td class="hidden-phone" style="">{{ $lot->description['fa'] }}</td>
                            <td class="hidden-phone"><span class="label label-primary">{{ $lot->status }}</span></td>
                            <td class="hidden-phone">{{ $lot->price }}</td>
                            <td class="hidden-phone">{{ $lot->type }}</td>
                            <td class="hidden-phone">{{ $lot->category->title['fa'] }}</td>
                            {{--<td>--}}
                            {{--{{ $lot->auction->title['fa'] }}--}}
                            {{--</td>--}}
                            <td class="hidden-phone">
                                <button onclick="addLotToAuction('{{$data['auction_id']}}','{{$lot->_id}}')" class="btn btn-success btn-xs"><i class="icon-ok"></i></button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$data['lots']->links()}}
            </section>
        </div>
    </div>

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
        function addLotToAuction(auction_id,lot_id) {
            $.ajax({
                url: '{{url('admin/auctions/add/lot')}}',
                type: 'post',
                data: {
                    _token:'{{csrf_token()}}',
                    lotId: lot_id,
                    auctionId: auction_id

                },
                success: function (response) {
                    $('#alert').html(response);
                    $('#alert').css('display','block');
                },
            });
        }
    </script>

    <script>

        $('.pagination a').on('click', function (event) {
            event.preventDefault();
            if ( $(this).attr('href') != '#' ) {
                $("html, body").animate({ scrollTop: 0 }, "fast");
                $('#lotsContent').load($(this).attr('href'));
            }
        });
    </script>
