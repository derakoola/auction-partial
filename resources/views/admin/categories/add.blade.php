@extends('admin.master.master')
<?php var_dump($errors->all()); ?>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    درج دسته بندی
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="post"
                              action="{{url('admin/categories/add')}}" novalidate="novalidate"   enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="title" class="control-label col-lg-2">عنوان</label>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title') ? ' error' : '' }}"
                                           name="title[fa]" minlength="2" placeholder="پارسی" type="text" required="">
                                    @if ($errors->has('title[fa]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title[fa]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <input class="form-control  {{ $errors->has('title') ? ' error' : '' }}"
                                           name="title[en]" minlength="2" placeholder="انگلیسی" type="text" required="">
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
                                              type="text" name="description[fa]" required="" placeholder="پارسی"></textarea>
                                    @if ($errors->has('description[fa]'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description[fa]') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-5">
                                    <textarea class="form-control {{ $errors->has('description') ? ' error' : '' }} "
                                              type="text" name="description[en]" required="" placeholder="انگلیسی"></textarea>
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
                                    <input class="form-control valid" name="image" type="file">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2">وضعیت</label>
                                <div class="col-lg-10">
                                    <div class="row m-bot15">
                                        <div class="col-sm-6 text-center">
                                            <div class="switch switch-square"
                                                 data-on-label="<i class=' icon-ok'></i>"
                                                 data-off-label="<i class='icon-remove'></i>">
                                                <input type="checkbox" name="status"/>
                                            </div>
                                        </div>

                                    </div>
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
    <!--custom switch-->
    <script src="{{url('asset/admin/js/bootstrap-switch.js')}}"></script>
@endsection