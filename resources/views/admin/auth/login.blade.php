@extends('admin.layouts.app')
@section('content')

    <body class="login-body">
<?php var_dump($errors->all()); ?>
    <div class="container">

        <form class="form-signin" method="post" action="{{ url('admin/login') }}">
            {{ csrf_field() }}
            <h2 class="form-signin-heading">همین حالا وارد شوید</h2>
            <div class="login-wrap">


                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <input type="text" name="username" class="form-control" placeholder="نام کاربری" autofocus>
                    @if ($errors->has('username'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="کلمه عبور">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>


                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> مرا به خاطر بسپار
                    <span class="pull-right"> <a href="#"> کلمه عبور را فراموش کرده اید؟</a></span>
                </label>
                <button class="btn btn-lg btn-login btn-block" type="submit">ورود</button>
                {{--<p>یا توسط یکی از حسابهای شبکه اجتماعی خود وارد شوید</p>--}}
                {{--<div class="login-social-link">--}}
                    {{--<a href="index.html" class="facebook">--}}
                        {{--<i class="icon-facebook"></i>--}}
                        {{--Facebook--}}
                    {{--</a>--}}
                    {{--<a href="index.html" class="twitter">--}}
                        {{--<i class="icon-twitter"></i>--}}
                        {{--Twitter--}}
                    {{--</a>--}}
                {{--</div>--}}

            </div>

        </form>

    </div>
    </body>
@endsection
