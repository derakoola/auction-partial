@extends('admin.master.master')
@section('content')
    <?php var_dump($errors->all()); ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    درج دسته بندی
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="post"
                              action="{{url('admin/auctions/add')}}" enctype="multipart/form-data"
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
                            <div class="form-group {{ $errors->has('managerId') ? ' has-error' : '' }} ">
                                <label for="managerId" class="control-label col-lg-2">مدیر حراجی</label>
                                <div class="col-lg-10">
                                    <input class="form-control {{ $errors->has('managerId') ? ' error' : '' }}"
                                           name="manager" id="manager" type="text" value="{{ old('manager') }}">
                                    <input type="hidden" name="managerId" id="managerId" value="{{ old('managerId') }}">


                                    @if ($errors->has('managerId'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('managerId') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title') ? ' error' : '' }}"
                                           name="title[fa]" minlength="2" placeholder="پارسی" type="text"
                                           value="{{ old('title.fa') }}">
                                    @if ($errors->has('title.fa'))
                                        <span class="help-block">
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
                            <textarea class="form-control {{ $errors->has('description') ? ' error' : '' }} "
                                      type="text" name="description[fa]"
                                      placeholder="پارسی">{{ old('description.fa') }}</textarea>
                                    @if ($errors->has('description.fa'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('description.fa') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                            <textarea class="form-control {{ $errors->has('description') ? ' error' : '' }} "
                                      type="text" name="description[en]"
                                      placeholder="انگلیسی">{{ old('description.en') }}</textarea>
                                    @if ($errors->has('description.en'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('description.en') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="curl" class="control-label col-lg-2">تصویر</label>
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
                            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="control-label col-lg-2">نوع حراجی</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-5">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getAuctionTypes() as $type)
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
                            <div class="form-group  {{ $errors->has('bidType') ? ' has-error' : '' }}">
                                <label for="curl" class="control-label col-lg-2">نوع پیشنهاد قیمت</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-5">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getBidTypes() as $bidType)
                                            <div class="radio">
                                                <label>
                                                    <input class="{{ $errors->has('bidType') ? ' error' : '' }}"
                                                           type="radio" name="bidType"
                                                           value="{{$bidType}}"
                                                           @if(old('bidType') == $bidType)
                                                           checked
                                                            @endif
                                                    >
                                                    {{$bidType}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($errors->has('bidType'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('bidType') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('bidType') ? ' has-error' : '' }}" id="bidRule"
                            >
                                <label for="curl" class="control-label col-lg-2">قوانین پیشنهاد قیمت</label>
                                <div class="col-lg-10">
                                    @for($i=0; $i<=4; $i++)
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" name="bidRuleFrom[]">
                                            </div>
                                            <div class="col-lg-4">
                                                <input class="form-control" type="text" name="bidRulePrice[]">
                                            </div>
                                        </div>
                                    </div>
                                    @endfor



                                    @if ($errors->has('bidType'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('bidType') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('bidAcceptance') ? ' has-error' : '' }} ">
                                <label for="curl" class="control-label col-lg-2">نوع پذیرفتن پیشنهاد قیمت</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-5">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getBidAcceptanceTypes() as $bidAcceptance)
                                            <div class="radio">
                                                <label>
                                                    <input class="{{ $errors->has('bidAcceptance') ? ' error' : '' }}"
                                                           type="radio" name="bidAcceptance"
                                                           value="{{$bidAcceptance}}"
                                                           @if(old('bidAcceptance') == $bidAcceptance)
                                                           checked
                                                            @endif

                                                    >
                                                    {{$bidAcceptance}}
                                                </label>
                                            </div>                                        @endforeach

                                    </div>
                                    @if ($errors->has('bidAcceptance'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('bidAcceptance') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('countryId') ? ' has-error' : '' }}">
                                <label for="country" class="control-label col-lg-2">نام کشور</label>
                                <div class="col-lg-10">
                                    <input type="text" name="country" id="country" class="form-control"
                                           value="{{old('country')}}">
                                    <input type="hidden" name="countryId" id="countryId"  value="{{old('countryId')}}">

                                    @if ($errors->has('countryId'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('countryId') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('startAt') ? ' has-error' : '' }}">
                                <label for="startAt" class="control-label col-lg-2">تاریخ شروع</label>
                                <div class="col-lg-10">
                                    <input type="text" name="startAt" class="form-control" value="{{old('startAt')}}">

                                    @if ($errors->has('startAt'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('startAt') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('finishAt') ? ' has-error' : '' }}">
                                <label for="finishAt" class="control-label col-lg-2">تاریخ پایان</label>
                                <div class="col-lg-10">
                                    <input type="text" name="finishAt" class="form-control"
                                           value="{{old('finishAt')}}">

                                    @if ($errors->has('finishAt'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('finishAt') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">واحد نرخ</label>
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
                            $('#userId').val(item._id);

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
        $('#manager').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/users/autocomplete')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
                            $('#managerId').val(item._id);

                            return {
                                label: item.firstName + ' ' + item.lastName,
                                value: item.firstName + ' ' + item.lastName,
                            }
                        }));
                    }
                });
            },
//                select: function (item) {
//                    $('#managerId').val(item.firstName + ' ' + item.lastName);
//                }
        });
    </script>
    <script type="text/javascript">
        $('#country').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/countries/all')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
                            $('#countryId').val(item._id);

                            return {
                                label: item.title.fa + ' ' + item.title.en,
                                value: item.title.fa + ' ' + item.title.en,
                            }
                        }));
                    }
                });
            },
//                select: function (item) {
//                    $('#managerId').val(item.firstName + ' ' + item.lastName);
//                }
        });
    </script>

    <script type="text/javascript">
        $('input[name=bidType]').click(function () {
            if ($(this).val() == 'auto') {
                $("#bidRule").slideDown('slow');
            }
            else {
                $("#bidRule").slideUp('slow');
            }
        });
    </script>
@endsection