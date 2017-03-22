@section('title',trans('web_v1.showAuction'))

<img src="asset/img/loading.gif" ng-show="loading" width="50" height="50">


<div id="show_auction" ng-show="showCurrency" class="<% locale %>">
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
                <div class="col-xs-12 col-sm-3">
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
                            <a href="" title="">View all</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6">
                    <div class="wall">
                            <img id="preview_on_fire_lot" ng-src="<%onFireLot.media.image.mediaPath%>" alt="lot title"
                                 class="img-responsive img-thumbnail">
                            {{--<button ng-click="calling()" class="btn btn-primary btn-sm">--}}
                                {{--First Call--}}
                            {{--</button>--}}
                            <a class="btn-bdalert"  ng-click="calling()" title="">Close Auction</a>
                    </div>
                    <div class="last-price">
                        <div class="box internal">
                            <small>Rial</small>
                            <div id="hottest_bid" class="counter" style="margin:0;"></div>

                        </div>
                        <div class="box foreign">
                            <small>Dollar</small>
                            <div id="hottest_bid_other_currency" class="counter" style="margin:0;"></div>

                        </div>
                        <a  class="participate-btn" ng-click="request_to_bid('<% id %>')"><span>Participate</span></a>
                    </div>
                    <div ng-if="showBid" >
                        <div class="send-price">
                            <form ng-submit="BidRequest(request)" >
                                <strong>Participate in the auction</strong>
                                <input type="tel" placeholder="" ng-model="request.bidAmount" name="bid-Amount" ng-value="hottestBid">
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


                <div class="col-xs-12 col-sm-2 col-sm-offset-1">
                    <ul class="waiting-line">
                        <li ng-repeat="queueLot in queueLots" ><img src="<% queueLot.media.image.mediaPath %>" alt="lot title" ng-class="(locale == 'fa') ? 'queue_lots_tn_fa' : ''" class="queue_lots_tn img-responsive img-thumbnail">
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <modal visible="showModal">
        <form novalidate>
            <div class="row">
                <div class="col-md-12 signinfield">
                    <div class="form-group mgb">
                        <input type="email" class="form-control" placeholder="Email address" id="signin-username" required data-validation-required-message="Please enter your email">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 signinfield">
                    <div class="form-group mgb">
                        <input type="password" class="form-control" placeholder="Password" id="signin-password" required data-validation-required-message="Please enter your password">
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 signinfield">

                    <div class="checkbox">
                        <input type="checkbox" class="icheckbox_flat" id="flat-checkbox-1">
                        <label for="flat-checkbox-1">Remember me</label>
                    </div>
                    <span style="float:right;"><a href="#">Forgot password?</a></span>


                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sign in</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <p>Dont have account? <a href="#" data-toggle="modal" data-target="#signup_modal" data-dismiss="modal">Join us</a> for free</p>
            </div>
        </form>
    </modal>
    <alert visible="showalert">
        <ul class="message-system">
            <li>  <% alertMessage %></li>
            <li>Please raise your bid amount</li>
        </ul>
    </alert>

</div>






























{{--<img src="asset/img/loading.gif" ng-show="loading" width="50" height="50">--}}

{{--<div id="show_auction" ng-show="showCurrency">--}}
    {{--<modal visible="showModal">--}}
        {{--<form novalidate>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12 signinfield">--}}
                    {{--<div class="form-group mgb">--}}
                        {{--<input type="email" class="form-control" placeholder="Email address" id="signin-username" required data-validation-required-message="Please enter your email">--}}
                        {{--<p class="help-block text-danger"></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--<div class="row">--}}
                {{--<div class="col-md-12 signinfield">--}}
                    {{--<div class="form-group mgb">--}}
                        {{--<input type="password" class="form-control" placeholder="Password" id="signin-password" required data-validation-required-message="Please enter your password">--}}
                        {{--<p class="help-block text-danger"></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="row">--}}
                {{--<div class="col-md-12 signinfield">--}}

                    {{--<div class="checkbox">--}}
                        {{--<input type="checkbox" class="icheckbox_flat" id="flat-checkbox-1">--}}
                        {{--<label for="flat-checkbox-1">Remember me</label>--}}
                    {{--</div>--}}
                    {{--<span style="float:right;"><a href="#">Forgot password?</a></span>--}}


                {{--</div>--}}

            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="submit" class="btn btn-primary">Sign in</button>--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
                {{--<p>Dont have account? <a href="#" data-toggle="modal" data-target="#signup_modal" data-dismiss="modal">Join us</a> for free</p>--}}
            {{--</div>--}}
        {{--</form>--}}
    {{--</modal>--}}
    {{--<modal visible="showalert">--}}
        {{--<% alertMessage %>--}}
    {{--</modal>--}}
        {{--<!-- header -->--}}
        {{--<div class="row">--}}
            {{--<div class="col-xs-12">--}}
                {{--<div class="panel panel-primary">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<h3 id="auction_info" class="panel-title">--}}
                            {{--<% auction.title[locale] %>--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                    {{--<div id="on_fire_lot" class="panel-body">--}}
                        {{--<% auction.description[locale] %>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<!-- body -->--}}
        {{--<div class="row row-eq-height spacerow">--}}

            {{--<!-- preview and bid form -->--}}
            {{--<div class="col-xs-7">--}}
                {{--<div class="box">--}}
                    {{--<div class="row row-eq-height">--}}
                        {{--<!-- lot queued -->--}}
                        {{--<div class="col-xs-2 dashRiBor">--}}
                            {{--<div id="queue_lots">--}}
                                {{--<div class="queue_lots_holder" ng-repeat="queueLot in queueLots">--}}
                                    {{--<div class="queue_lots_holder">--}}
                                        {{--<img src="<% queueLot.media.image.mediaPath %>" alt="lot title" class="queue_lots_tn img-responsive img-thumbnail">--}}
                                        {{--<div class="info_queue_lots">--}}
                                            {{--<img class="img-responsive" src="<% queueLot.media.image.mediaPath %>">--}}
                                            {{--<span>--}}
                                                {{--<strong><%queueLot._order%> </strong> <%queueLot.title[locale]%></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- the lot on fire -->--}}
                        {{--<div class="col-xs-10">--}}

                            {{--<img id="preview_on_fire_lot" src="<%onFireLot.media.image.mediaPath%>" alt="lot title"--}}
                                 {{--class="img-responsive img-thumbnail">--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- bids -->--}}
            {{--<div class="col-xs-3">--}}
                {{--<div class="box" id="notifications">--}}
                    {{--<div class="alert alert-warning" ng-if="notification" ng-repeat="auctionNotification in auctionNotifications track by $index">--}}
                        {{--<p> <% auctionNotification %></p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- manage area -->--}}
            {{--<div class="col-xs-2">--}}
                {{--<div class="box">--}}
                    {{--<div>--}}
                        {{--<button ng-click="calling()" class="btn btn-primary btn-sm">--}}
                            {{--First Call--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}

        {{--<!-- bid form -->--}}
        {{--<div class="row spacerow">--}}
            {{--<!-- bid options -->--}}
            {{--<div class="col-xs-2">--}}

                {{--<div class="bid_options">--}}
                    {{--<select ng-model="locale" ng-change="locale_change(locale)">--}}
                        {{--<option ng-repeat="(key,value) in locales" value="<%key%>"--}}
                                {{--ng-selected="<%key == locale%>"><%value.native%></option>--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="bid_options">--}}
                    {{--<select ng-model="userCurrency" ng-change="currency_change(userCurrency)">--}}
                        {{--<option ng-repeat="(key,value) in currencies" value="<%key%>"--}}
                                {{--ng-selected="<%key == userCurrency%>"><%value.title%></option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- latest bid -->--}}
            {{--<div class="col-xs-7 text-center">--}}
                {{--<div class="counter_holder">--}}
                    {{--<div id="hottest_bid" class="hottest_bid" style="margin:2em;"></div>--}}
                    {{--<div style="margin:2em;zoom: 0.5;-moz-transform: scale(0.5)" id="hottest_bid_other_currency" ng-if="userCurrency != 'toman'" ></div>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<h4>--}}
                        {{--<button style="display: none;" class="btn btn-primary" id="request_to_bid">Request to bid--}}
                        {{--</button>--}}
                    {{--</h4>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</div>--}}
