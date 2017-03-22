<?php $segment = \Request::segment(2); ?>


<div class="modal fade full-modal" id="search-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="search-modal">
                    <form>
                        <select class="js-example-basic-single js-states form-control">
                            <option>Popular Searches</option>
                            <option>Brands</option>
                            <option>Origins</option>
                            <option>Artists & Creators</option>
                        </select>
                        <input type="text" placeholder="{{trans('search.searchText')}}">
                        <input type="submit" value="Search">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<header>
    <div class="language">
        <div class="container">
            <ul>
                <li @if(app()->getLocale() == 'fa')  class="active" @endif><a href="{{ url('/fa') }}" title="Farsi">فا</a></li>
                <li @if(app()->getLocale() == 'en')  class="active" @endif><a href="{{ url('/en') }}" title="English">En</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <h1 class="logo"><a href="" title="Online auction">Online auction</a></h1>
            <div class="top">
                <a href="#cd-nav" class="cd-nav-trigger notifications" title="">Notifications</a>
                <a class="search" data-toggle="modal" data-target="#search-form" title="">search</a>
            </div>
            <nav class="navbar">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="" title="{{ trans('web_v1.home') }}">{{ trans('web_v1.home') }}</a></li>

                        <li @if($segment=='auctions') class="active" @endif>
                            <a  ng-href="#/auctions" title="{{ trans('web_v1.hotAuctions') }}">{{ trans('web_v1.hotAuctions') }}
                                @if($segment=='auctions') <span class="sr-only">{{ trans('web_v1.currentMenu') }}</span> @endif
                            </a>
                        </li>
                        {{--<li><a href="" title="Today auction">Today auction</a></li>--}}
                        {{--<li><a href="" title="Guide">Guide</a></li>--}}
                        <li><a ng-href="#/about" title="{{ trans('web_v1.aboutUs') }}">{{ trans('web_v1.aboutUs') }}</a></li>
                        <li><a ng-href="#/contact" title="{{ trans('web_v1.contactUs') }}">{{ trans('web_v1.contactUs') }}</a></li>
                        <li @if($segment=='account') class="active" @endif>
                            <a href="{{ url(app()->getLocale().'/account') }}"  title="Account">{{ trans('web_v1.account') }}
                                @if($segment=='account') <span class="sr-only">{{ trans('web_v1.currentMenu') }}</span> @endif
                            </a>
                        </li>

                    </ul>

                </div>
            </nav>
        </div>
    </div>

</header>
