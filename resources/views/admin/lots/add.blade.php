@extends('admin.master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    درج کالا
                </header>
                <div class="panel-body">
                    <div id="response"></div>
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" id="addLotForm" method="post"
                              action="{{url('admin/lots/add')}}" enctype="multipart/form-data"
                        >
                            {{csrf_field()}}

                            <div class="form-group {{ $errors->has('userId') ? ' has-error' : '' }}">
                                <label for="userId" class="control-label col-lg-2">صاحب حراجی</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('userId') ? ' error' : '' }}"
                                           name="user" id="user" type="text" value="{{ old('user') }}">
                                    <input type="hidden" name="userId" id="userId" value="{{ old('userId') }}">

                                    @if ($errors->has('userId'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('userId') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('creator_id') ? ' has-error' : '' }}">
                                <label for="creator_id" class="control-label col-lg-2"> سازنده</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('creator_id') ? ' error' : '' }}"
                                           name="creator" id="creator" type="text" value="{{ old('user') }}">
                                    <input type="hidden" name="creator_id" id="creator_id" value="{{ old('creator_id') }}">

                                    @if ($errors->has('creator_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('creator_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="control-label col-lg-2">تصویر</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('image') ? ' error' : '' }}"
                                           name="image" type="file">

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('title.fa') ? ' has-error' : '' }} ">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title.fa') ? ' error' : '' }}"
                                           name="title[fa]" minlength="2" placeholder="پارسی" type="text"
                                           value="{{ old('title.fa') }}">
                                    @if ($errors->has('title.fa'))
                                        <span class="help-block ">
                            <strong>{{ $errors->first('title.fa') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title.en') ? ' error' : '' }}"
                                           name="title[en]" minlength="2" placeholder="انگلیسی" type="text"
                                           value="{{ old('title.en') }}">
                                    @if ($errors->has('title.en'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('title.en') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} ">
                                <label for="description" class="control-label col-lg-2">توضیح</label>
                                <div class="col-lg-5">
                            <textarea class="form-control {{ $errors->has('description.fa') ? ' error' : '' }} "
                                      type="text" name="description[fa]"
                                      placeholder="پارسی">{{ old('description.fa') }}</textarea>
                                    @if ($errors->has('description.fa'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('description.fa') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                            <textarea class="form-control {{ $errors->has('description.en') ? ' error' : '' }} "
                                      type="text" name="description[en]"
                                      placeholder="انگلیسی">{{ old('description.en') }}</textarea>
                                    @if ($errors->has('description.en'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('description.en') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }} ">
                                <label for="description" class="control-label col-lg-2">قیمت</label>
                                <div class="col-lg-10">
                                    <input class="form-control {{ $errors->has('price') ? ' error' : '' }} "
                                           type="text" name="price"
                                           placeholder="قیمت">{{ old('price') }}
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                            </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group {{ $errors->has('currency') ? ' has-error' : '' }} ">
                                <label for="description" class="control-label col-lg-2">ارز</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15 {{ $errors->has('currency') ? ' error' : '' }}"
                                            name="currency">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getCurrencies() as $currency=>$currencyInfo)
                                            <option value="{{$currency}}"
                                                    @if(old('currency') == $currency) checked @endif
                                            >{{$currencyInfo['title']}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('currency') }}</strong>
                            </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="control-label col-lg-2">نوع کالا</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-5">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getLotTypes() as $type)
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" value="{{$type}}"
                                                           @if(old('type') == $type)
                                                           checked
                                                            @endif
                                                    >
                                                    {{$type}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('type') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('categoryId') ? ' has-error' : '' }}">
                                <label for="curl" class="control-label col-lg-2">دسته بندی</label>
                                <div class="col-lg-10">

                                    <select class="form-control m-bot15 {{ $errors->has('categoryId') ? ' error' : '' }}"
                                            name="categoryId">
                                        @foreach(\App\Models\Api\V1\Category::all() as $category)
                                            <option value="{{$category->_id}}"
                                                    @if(old('categoryId') == $category->id)
                                                    selected
                                                    @endif
                                            >{{$category->title['fa']}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('categoryId'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('categoryId') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-danger" type="submit">ذخیره</button>
                                    <button class="btn btn-default" type="button">انصراف</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $('#user').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/users/autocomplete')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
                            $('#ownerId').val(item._id);

                            return {
                                label: item.firstName + ' ' + item.lastName,
                                value: item.firstName + ' ' + item.lastName,
                            }
                        }));
                    }
                });
            },
//                select: function (item) {
//                    $('#userId').val(item.firstName + ' ' + item.lastName);
//                }
        });
    </script>
 <script type="text/javascript">
        $('#creator').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/users/autocomplete')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
                            $('#creatorId').val(item._id);

                            return {
                                label: item.firstName + ' ' + item.lastName,
                                value: item.firstName + ' ' + item.lastName,
                            }
                        }));
                    }
                });
            },
//                select: function (item) {
//                    $('#userId').val(item.firstName + ' ' + item.lastName);
//                }
        });
    </script>

@endsection