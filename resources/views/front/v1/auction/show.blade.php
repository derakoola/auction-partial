@section('title',trans('web_v1.showAuction'))
<link href="{{ url('asset/front/css/styleauction.css') }}" rel="stylesheet">

<img src="asset/img/loading.gif" ng-show="loading" width="50" height="50">


    <div id="show_auction" ng-show="showCurrency" class="<% locale %>">
        <modal id="login" visible="showModal" >
            <div class="box">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 los1">
                        <h5>{{trans('auth.login')}}</h5>
                        <form>
                            <div class="box-input">
                                <label>{{trans('auth.email')}}</label>
                                <input type="" placeholder="">
                            </div>
                            <div class="box-input">
                                <label>{{trans('auth.password')}}</label>
                                <input type="" placeholder="">
                            </div>
                            <div class="cbox">
                                <input type="checkbox" name="remember" id="remember" />
                                <label for="remember">{{trans('auth.rememberMe')}}</label>
                            </div>
                            <button class="button button--aylen" type="button">{{trans('auth.login')}}</button>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-6 los2">
                        <h5>{{trans('auth.register')}}</h5>
                        <form>
                            <div class="box-input">
                                <label>{{trans('auth.name')}}</label>
                                <input type="" placeholder="">
                            </div>
                            <div class="box-input">
                                <label>{{trans('auth.email')}}</label>
                                <input type="" placeholder="">
                            </div>
                            <div class="box-input">
                                <label>{{trans('auth.phoneNumber')}}</label>
                                <input type="" placeholder="">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box-input">
                                        <label>{{trans('auth.password')}}</label>
                                        <input type="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box-input">
                                        <label>{{trans('auth.repeatPassword')}}</label>
                                        <input type="" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <button class="button button--aylen" type="button">{{trans('auth.register')}}</button>
                        </form>
                    </div>
                </div>
                <div class="forget-password">
                    <a href="" title="">{{trans('auth.forgotPassword')}}</a>
                </div>
            </div>
        </modal>

        <section class="auction-name">
            <h2>GEORGES AROU ABSTRACT PAINTING</h2>
        </section>
        <div class="auction-text">
            <div class="container">
                <p>  <% auction.description[locale] %></p>
            </div>

        </div>
        <section class="auction-moment">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        <div class="statement">
                            <h4>Statement</h4>
                            <ul>
                                <li class="alert alert-dismissible" role="alert" ng-repeat="auctionNotification in auctionNotifications track by $index">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p><% auctionNotification %></p>
                                    <span class="time">10 min ago</span>
                                </li>

                            </ul>
                            <div class="all">
                                <a href="" title="">{{ trans('web_v1.viewAll') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-6">
                        <div class="wall">
                                <img id="preview_on_fire_lot" ng-src="<%onFireLot.media.image.mediaPath%>" alt="lot title"
                                     class="img-responsive">
                        </div>
                        <div class="last-price">
                            <div class="box internal">
                                <small>{{ trans('web_v1.rial') }}</small>
                                <div id="hottest_bid" class="counter" style="margin:0;"></div>

                                {{--<% hottestBid %>--}}
                            </div>
                            <div class="box foreign">
                                <small>{{ trans('web_v1.dollar') }}</small>

                                <div id="hottest_bid_other_currency" class="counter" style="margin:0;"></div>
                                {{--<% hottestBidOtherCurrency %>--}}
                            </div>


                            <a class="participate-btn"  ng-click="request_to_bid('<% id %>')"><span>{{trans('web_v1.participate')}}</span></a>
                        </div>
                        <div ng-if="showBid" >
                            <div class="send-price">
                                <form ng-submit="BidRequest(request)" >
                                    <strong>Participate in the auction</strong>
                                    <input type="tel" placeholder="" ng-model="request.bidAmount" name="bidAmount">
                                    <p ng-if="showEnterPrice"> please enter a new price</p>
                                    <div class="authentication">
                                        <span>Authentication</span>
                                        <ul class="rbox">
                                            <li>
                                                <input type="radio" name="authentication" id="ac1" ng-model="Identity" ng-click="showMyIdentity()" />
                                                <label for="ac1">Publish Your Name</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="authentication" id="ac2" ng-model="Identity" ng-click="hideMyIdentity()"/>
                                                <label for="ac2">Hide your identity</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="submit" value="submit">
                                </form>


                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-lg-offset-1">
                        <ul class="waiting-line">
                            <li ng-repeat="queueLot in queueLots" ><img src="<% queueLot.media.image.mediaPath %>" alt="lot title" ng-class="(locale == 'fa') ? 'queue_lots_tn_fa' : ''" class="queue_lots_tn img-responsive ">
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <alert visible="showalert">
            <ul class="message-system">
                <li>  <% alertMessage %></li>
                <li>Please raise your bid amount</li>
            </ul>
        </alert>


      </div>