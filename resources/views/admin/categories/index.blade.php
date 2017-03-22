@extends('admin.master.master')
@section('content')
    <div id="alert" class="alert alert-success" style="display: none"> </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    لیست دسته بندی ها

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
                        <th class="hidden-phone">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['categories'] as $category)
                        <tr class="odd gradeX" id="{{$category->_id}}">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1"/></td>
                            <td><img src="{{ url($category->media['image']['mediaPath'])}}" height="50" width="50"></td>
                            <td>{{ $category->title['fa'] }}</td>
                            <td class="hidden-phone" style="">{{ $category->description['fa'] }}</td>
                            <td class="hidden-phone"><span class="label label-success">{{ $category->status }}</span></td>
                            <td>
                                <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="deleteCategory('{{ $category->_id }}')"><i class="icon-trash "></i></button>
                            </td>
                                                <td class="center hidden-phone">{{ $category->title['fa'] }}</td>
                            <td class="hidden-phone">
                            <button class="btn btn-danger">حذف</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$data['categories']->links()}}
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function deleteCategory(category_id) {
            if (!confirm('آیا میخواهید این دسته بندی را حذف کنید؟')) {
                return false;
            }
            else {
                $.ajax({
                    url: '{{url('admin/category/delete')}}' + '/' + category_id,
                    type: 'get',
                    success: function (response) {
                        console.log(response.data);
                        $('#' + category_id).remove();
                        $('#alert').html('دسته بندی مورد نظر با موفقیت حذف شد');
                        $('#alert').css('display','block');
                    },
                });
            }

        }


    </script>
@endsection