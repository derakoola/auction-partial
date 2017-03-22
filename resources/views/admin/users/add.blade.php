@extends('admin.master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">

                    افزودن کاربر جدید
                </header>
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal tasi-form" method="post"
                              action="{{url('admin/users/add')}}" novalidate="novalidate"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group {{ $errors->has('firstName') ? ' has-error' : '' }}">
                                <label for="firstName" class="control-label col-lg-2">نام</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('firstName') ? ' error' : '' }}"
                                           name="firstName" id="firstName" type="text" value="{{ old('firstName') }}">

                                    @if ($errors->has('firstName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('lastName') ? ' has-error' : '' }}">
                                <label for="lastName" class="control-label col-lg-2">نام خانوادگی</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('lastName') ? ' error' : '' }}"
                                           name="lastName" id="lastName" type="text" value="{{ old('lastName') }}">

                                    @if ($errors->has('lastName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('_email') ? ' has-error' : '' }}">
                                <label for="_email" class="control-label col-lg-2">ایمیل</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('_email') ? ' error' : '' }}"
                                           name="_email" id="_email" type="text" value="{{ old('_email') }}">

                                    @if ($errors->has('_email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="control-label col-lg-2">نام کاربری</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('username') ? ' error' : '' }}"
                                           name="username" id="username" type="text" value="{{ old('username') }}">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label col-lg-2">رمز عبور</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('password') ? ' error' : '' }}"
                                           name="password" id="password" type="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                         <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation" class="control-label col-lg-2">تکرار رمز عبور</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('password_confirmation') ? ' error' : '' }}"
                                           name="password_confirmation" id="password_confirmation" type="password">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                             <div class="form-group {{ $errors->has('_phone') ? ' has-error' : '' }}">
                                <label for="_phone" class="control-label col-lg-2">شماره تلفن</label>
                                <div class="col-lg-10">
                                    <input class="form-control valid  {{ $errors->has('_phone') ? ' error' : '' }}"
                                           name="_phone" id="_phone" type="text" value="{{ old('_phone') }}">

                                    @if ($errors->has('_phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group {{ $errors->has('_permissions') ? ' has-error' : '' }}">--}}
                                {{--<label for="_permissions" class="control-label col-lg-2">شماره تلفن</label>--}}
                                {{--<div class="col-lg-10">--}}
                                    {{--<select name="_permissions[]" multiple>--}}
                                        {{--@foreach(App\Helpers\Admin\AdminHelper::getPermissions() as $permission)--}}
                                            {{--<option value="{{$permission}}">{{$permission}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}


                                    {{--@if ($errors->has('_permissions'))--}}
                                        {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('_permissions') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}


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
