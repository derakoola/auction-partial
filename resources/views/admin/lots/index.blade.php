@extends('admin.master.master')
@section('content')
    <div id="alert" class="alert alert-success" style="display: none;position: fixed;top:0px;left:0px;z-index: 1000000;"> </div>
    <div class="row">
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
                        <th class="hidden-phone">حراجی</th>
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
                            <td class="hidden-phone"><span class="label label-success">{{ $lot->status }}</span></td>
                            <td class="hidden-phone">{{ $lot->price }}</td>
                            <td class="hidden-phone">{{ $lot->type }}</td>
                            <td class="hidden-phone">{{ $lot->category->title['fa'] }}</td>
                            {{--<td>--}}
                                {{--{{ $lot->auction->title['fa'] }}--}}
                            {{--</td>--}}
                            <td class="hidden-phone">
                                <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="deleteLot('{{ $lot->_id }}')"><i class="icon-trash "></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$data['lots']->links()}}
            </section>
        </div>
    </div>
@endsection

@section('js')
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

@endsection