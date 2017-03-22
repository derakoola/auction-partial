@extends('front.v1.app.master')

@section('title',trans('web_v1.account'))

@section('js')


    {{-- init --}}
    <script type="text/javascript">
        $(document).ready(function () {

            $.removeCookie('user');
            $.cookie('user', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI1ODA2MjQ1M2UxMzgyMzAzNjc2YjAyMTgiLCJpc3MiOiJodHRwOlwvXC8xOTkuMjAxLjEyMy4yMjhcL2FwaV93ZWJcL3B1YmxpY1wvYXBpXC92MVwvdXNlclwvbG9naW4iLCJpYXQiOjE0NzY4ODI4MDAsImV4cCI6MTY5NDYwNzIwMCwibmJmIjoxNDc2ODgyODAwLCJqdGkiOiJkNjg1NjI2M2VkN2EyNDhhMDlmMjUyOTQ0MTY0YTEyZSJ9.dg6WUGnRhiSZhNq31OXtvjpvpG1n1ludQStUn27OPCk', {
                expires: 365,
                path: '/'
            });
            window.user = $.cookie('user');
        });
    </script>


@endsection

@section('content')

    @include('front.v1.account.login',[ 'hide'=>true ])

    @include('front.v1.account.register',[ 'hide'=>true ])

@endsection
