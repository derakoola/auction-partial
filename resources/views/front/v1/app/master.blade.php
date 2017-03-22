
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="auctionApp" ng-controller="AuctionAppCtrl" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>{{ trans('web_v1.mainTitle') }} - @yield('title')</title>

    <link href="{{ url('asset/front/css/bootstrap.min.css') }}" rel="stylesheet">
{{--    <link ng-if="rtl == 'fa'" href="{{ url('asset/front/bootstrap-rtl/css/bootstrap-rtl.min.css') }}" rel="stylesheet" >--}}
    <link rel="stylesheet" type="text/css" href="{{ url('asset/front/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('asset/front/css/morphing.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('asset/front/css/plugins/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('asset/front/css/plugins/owl.carousel.css') }}">
    <link href="{{ url('asset/front/css/bootflat.min.css') }}" rel="stylesheet">
    <link href="{{ url('asset/front/css/flipclock.css') }}" rel="stylesheet">
    <link href="{{ url('asset/front/css/bootstrap-slider.min.css') }}" rel="stylesheet">
     <link href="{{ url('asset/front/css/style.css') }}" rel="stylesheet">


    @yield('css')


</head>
<body @if(app()->getLocale() == 'fa') class="language-fa" @endif>

<main>
    @include('front.v1.app.menu')

    <div ng-view >


    </div>

</main>


<nav class="cd-nav-container" id="cd-nav">
    <header>
        <h3>Notifications</h3>
        <a href="#0" class="cd-close-nav">Close</a>
    </header>
    <div class="cont-body">
        <span>No notifications available</span>
    </div>
</nav>
<div class="cd-overlay"></div>


<script src="{{ url('asset/front/jquery/jquery-3.1.1.min.js') }}"></script>
<script src="{{ url('asset/front/bootstrap-3-3-7/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<script type="text/javascript" src="{{ url('asset/front/js/plugins/navigation.js')}}"></script>
<script type="text/javascript" src="{{ url('asset/front/js/plugins/select2.min.js')}}"></script>
<script type="text/javascript" src="{{ url('asset/front/js/plugins/owl.carousel.min.js')}}"></script>
<script src="{{ url('asset/front/js/bootstrap-slider.min.js') }}"></script>

<script src="{{ url('asset/front/js/functions.js') }}"></script>
<script src="{{ url('asset/front/jquery/jquery.cookie.js') }}"></script>
<script src="{{ url('asset/front/js/jquery.fs.selecter.min.js') }}"></script>
<script src="{{ url('asset/front/js/icheck.min.js') }}"></script>
<script src="{{ url('asset/front/js/jquery.fs.stepper.min.js') }}"></script>
<script src="{{ url('asset/front/js/flipclock.min.js') }}"></script>
<script src="{{ url('asset/front/js/flipclock.min.js') }}"></script>
<script src="{{ url('asset/front/js/modernizr.custom.js') }}"></script>

<script src="{{ url('asset/front/angular/angular.js')}}"></script>

<script src="{{ url('asset/front/angular-route/angular-route.js')}}"></script>
<script src="{{ url('asset/front/angular-cookies/angular-cookies.js')}}"></script>
<script src="{{ url('asset/front/socket.io-client/socket.io.js')}}"></script>
<script src="{{ url('asset/front/angular-socket-io/socket.js')}}"></script>
<script src="{{ url('asset/front/js/functions.js')}}"></script>
<script src="{{ url('asset/front/js/morphing.js')}}"></script>
<script src="{{ url('asset/front/js/morphing-fixed.js')}}"></script>


<script src="{{ url('app/scripts/app.js')}}"></script>
<script src="{{ url('app/scripts/services/auctionService.js')}}"></script>
<script src="{{ url('app/scripts/controllers/HomeCtrl.js')}}"></script>
<script src="{{ url('app/scripts/controllers/AuctionsCtrl.js')}}"></script>
<script src="{{ url('app/scripts/controllers/AuctionCtrl.js')}}"></script>
<script src="{{ url('app/scripts/controllers/AuctionAppCtrl.js')}}"></script>
<script src="{{ url('app/scripts/controllers/AuthCtrl.js')}}"></script>
<script src="{{ url('app/scripts/controllers/AuctionManageCtrl.js')}}"></script>
<script src="{{ url('app/scripts/controllers/AuctionDetailCtrl.js')}}"></script>
<script src="{{ url('app/scripts/services/authService.js')}}"></script>
<script src="{{ url('app/scripts/services/currencyService.js')}}"></script>
<script src="{{ url('app/scripts/services/localeService.js')}}"></script>
<script src="{{ url('app/scripts/services/socketService.js')}}"></script>
<script src="{{ url('app/scripts/services/categoryService.js')}}"></script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script type="text/javascript">
    locale = '{{ app()->getLocale() }}';
    currency = '{{ session('currency','toman') }}';
    $("input.iradio_flat").iCheck({radioClass: "iradio_flat", increaseArea: "20%"});
    $("input.icheckbox_flat").iCheck({checkboxClass: "icheckbox_flat", increaseArea: "0%"});
    $(document).ready(function() {
        $(".js-example-basic-single").select2();
    });
</script>

{{--<script type="text/javascript">--}}
    {{--$(document).ready(function() {--}}
        {{--$('.full-slider').owlCarousel({--}}
            {{--animateOut: 'fadeOut',--}}
            {{--animateIn: 'fadeIn',--}}
            {{--autoplay:true,--}}
            {{--autoplayTimeout:5000,--}}
            {{--loop:true,--}}
            {{--items:1,--}}
            {{--margin:0,--}}
            {{--stagePadding:0,--}}
            {{--smartSpeed:450--}}
        {{--});--}}
        {{--$(".js-example-basic-single").select2();--}}
    {{--});--}}
{{--</script>--}}
{{--@yield('js')--}}

</body>
</html>
