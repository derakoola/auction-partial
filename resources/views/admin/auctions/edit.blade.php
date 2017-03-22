@extends('admin.master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ویرایش دسته بندی
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="post"
                              action="{{url('admin/auctions/edit')}}" novalidate="novalidate"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$auction->_id}}" name="auction_id">
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">صاحب حراجی</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('userId') ? ' error' : '' }}"
                                           name="user" id="userId" type="text"
                                           value="{{$auction->owner['user']['firstName'] . ' ' . $auction->owner['user']['lastName']}}">
                                    <input type="hidden" name="userId" id="userId" value="{{$auction['owner']['user']['userId'] }}">

                                </div>
                                @if ($errors->has('userId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userId') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">مدیر حراجی</label>
                                <div class="col-lg-10">
                                    <input class="form-control {{ $errors->has('managerId') ? ' error' : '' }}"
                                           name="manager" id="managerId" type="text"
                                           value="{{$auction->manager['user']['firstName'] . ' ' . $auction->manager['user']['lastName']}}">
                                    <input type="hidden" name="managerId" id="managerId" value="{{$auction['manager']['user']['userId'] }}">

                                </div>
                                @if ($errors->has('managerId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('managerId') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title') ? ' error' : '' }}"
                                           name="title[fa]" minlength="2" placeholder="پارسی" type="text"
                                           required="" value="{{$auction->title['fa']}}">
                                    @if ($errors->has('title[fa]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title[fa]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title') ? ' error' : '' }}"
                                           name="title[en]" minlength="2" placeholder="انگلیسی" type="text"
                                           required="" value="{{$auction->title['en']}}">
                                    @if ($errors->has('title[en]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title[en]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="control-label col-lg-2">توضیح</label>
                                <div class="col-lg-5">
                                    <textarea class="form-control {{ $errors->has('description') ? ' error' : '' }} "
                                              type="text" name="description[fa]" required=""
                                              placeholder="پارسی">{{$auction->description['fa']}}</textarea>
                                    @if ($errors->has('description[fa]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description[fa]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <textarea class="form-control {{ $errors->has('description') ? ' error' : '' }} "
                                              type="text" name="description[en]" required=""
                                              placeholder="انگلیسی">{{$auction->description['en']}}</textarea>
                                    @if ($errors->has('description[en]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description[en]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">تصویر</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('image') ? ' error' : '' }}"
                                           name="image" type="file">
                                </div>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">نوع حراجی</label>
                                <div class="col-lg-10">
                                    @foreach(\App\Helpers\Admin\AdminHelper::getAuctionTypes() as $type)
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="{{$type}}"
                                                       @if($auction->type == $type) checked="checked" @endif
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
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">دسته بندی</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15 {{ $errors->has('categoryId') ? ' error' : '' }}"
                                            name="categoryId">
                                        @foreach(\App\Models\Api\V1\Category::all() as $category)
                                            <option value="{{$category->_id}}"
                                                    @if($auction->categoryId == $category->_id)
                                                    selected="selected"
                                                    @endif
                                            >{{$category->title['fa']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('categoryId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoryId') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">نوع پیشنهاد قیمت</label>
                                <div class="col-lg-10">
                                    @foreach(\App\Helpers\Admin\AdminHelper::getBidTypes() as $bidType)
                                        <div class="radio">
                                            <label>
                                                <input class="{{ $errors->has('bidType') ? ' error' : '' }}"
                                                       type="radio" value="{{$bidType}}"
                                                       @if($auction->bidType == $bidType) checked @endif>
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
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">نوع پذیرفتن پیشنهاد قیمت</label>
                                <div class="col-lg-10">
                                    @foreach(\App\Helpers\Admin\AdminHelper::getBidAcceptanceTypes() as $bidAcceptance)
                                        <div class="radio">
                                            <label>
                                                <input class="{{ $errors->has('bidAcceptance') ? ' error' : '' }}"
                                                       type="radio"
                                                       value="{{$bidAcceptance}}"
                                                       @if($auction->bidAcceptance == $bidAcceptance) checked @endif>
                                                {{$bidAcceptance}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @if ($errors->has('bidAcceptance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bidAcceptance') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="countryId" class="control-label col-lg-2">نام کشور</label>
                                <div class="col-lg-10">
                                    <input type="text" name="countryId" class="form-control"
                                           value="{{$auction['country']['country']['title']['fa']}}">
                                    <input type="hidden" name="countryId" id="countryId"  value="{{$auction['country']['country']['countryId']}}">

                                </div>
                                @if ($errors->has('countryId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('countryId') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="start_at" class="control-label col-lg-2">تاریخ شروع</label>
                                <div class="col-lg-10">
                                    <input type="text" name="start_at" class="form-control"
                                           value="{{$auction->startAt}}">
                                </div>
                                @if ($errors->has('start_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="finish_at" class="control-label col-lg-2">تاریخ پایان</label>
                                <div class="col-lg-10">
                                    <input type="text" name="finish_at" class="form-control"
                                           value="{{$auction->finishAt}}">
                                </div>
                                @if ($errors->has('finish_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finish_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">واحد نرخ</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15 {{ $errors->has('currency') ? ' error' : '' }}"
                                            name="currency">
                                        @foreach(\App\Helpers\Admin\AdminHelper::getCurrencies() as $currency=>$currencyInfo)
                                            <option value="{{$currency}}"
                                                    @if($auction->currency == $currency)
                                                    selected="selected"
                                                    @endif>{{$currencyInfo['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('currency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency') }}</strong>
                                    </span>
                                @endif
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
        $('#userId').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/users/autocomplete')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
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
        $('#managerId').autocomplete({

            source: function (request, response) {
                console.log(request);
                $.ajax({
                    url: '{{url('admin/users/autocomplete')}}' + '?filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
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
        $('input[name=\'start_at\']').datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('input[name=\'finish_at\']').datepicker({
            dateFormat: "yy-mm-dd"

        });
    </script>
@endsection