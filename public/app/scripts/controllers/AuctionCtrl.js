
angular.module('AuctionCtrl', ['auctionService', 'currencyService','socketService'])

    .controller('AuctionCtrl',['$scope' ,'Auction','socketIo','Currency','Locale', '$routeParams','$location','$cookies','$rootScope',
        function($scope,Auction,socketIo,Currency,Locale, $routeParams, $location, $cookies,$rootScope) {
            $scope.locale = locale;
            $scope.currency = currency;
             var math = window.Math;

            $scope.showRequestButton = true;
            $scope.showModal=false;
            $scope.showalert=false;

            var userCurrency = $cookies.get('userCurrency');
            if(typeof userCurrency == 'undefined') {
                var userCurrency = 'irr';
            }
            // if(userCurrency == 'toman') {
            //     $scope.showOtherCurrency = false;
            //
            // } else {
            //     $scope.showOtherCurrency = true;
            //
            // }

            $scope.userCurrency = userCurrency;
            $scope.loading = true;
            $scope.id = $routeParams.id;
            var user = $cookies.get('user');

            $scope.showMyIdentity = function () {
                var showBidderIdentity = 'yes';
                $scope.showBidderIdentity = showBidderIdentity;
                // console.log(showBidderIdentity);
            }
            $scope.hideMyIdentity = function () {
                var showBidderIdentity = 'no';
                $scope.showBidderIdentity = showBidderIdentity;
                // console.log(showBidderIdentity);

            }
            if(typeof showBidderIdentity == 'undefined'){
                $scope.showBidderIdentity = 'no';
            }
            var promise = Locale.getAll()
            promise.then(function(response){

                $scope.locales = response;

            });
            // console.log(response);
            $scope.calling = function () {
                if (typeof user == 'undefined') {
                    $scope.showModal = false;
                    $scope.showModal = true;


                    return false;
                }
                Auction.nextStage($routeParams.id, user)
                    .success(function (response) {
                        if(response.status == 'fail') {
                            $scope.showalert = true;
                            $scope.alertMessage = response.message;
                        }
                    })
            }

            var promise = Currency.getAll()
            promise.then(function (response) {

                var currencies = response;
                $scope.currencies = currencies;
                Auction.join($routeParams.id)
                    .success(function (response) {
                        $scope.auctionNotifications = [];
                        $scope.socket = response.data.socket;
                        socketIo.init(response.data.socket)
                        socketIo.on("connect", function () {
                            socketIo.on("message", function (message) {
                                // console.log(message);
                                message = JSON.parse(message);
                                if(message.action == 'auctionNextStage') {
                                    if (message.data.nextStage) {
                                        var auctionNotification = message.data.nextStage.stage;
                                    }
                                    else {
                                        var auctionNotification = 'Sold';
                                        onFireLot = $scope.onFireLot;
                                        var order = $scope.onFireLot._order + 1;
                                        var userCurrency = $scope.usercurrency;

                                        angular.forEach(auction.lots, function (lot, lotId) {
                                            if (lot._order == order) {
                                                $scope.onFireLot = auction.lots[lotId];
                                                // $scope.hottestBid = auction.lots[lotId].hottestBid;
                                                // $scope.hottestBidOtherCurrency = auction.lots[lotId].hottestBid * currencies[currency].values[userCurrency];
                                                var clock = $('#hottest_bid').FlipClock(auction.lots[lotId].hottestBid, {
                                                    clockFace: 'Counter',
                                                    autoStart: false,
                                                    autoPlay: false,
                                                    minimumDigits: 1
                                                });
                                                setInterval(function () {
                                                    clock.setTime("﷼" + auction.lots[lotId].hottestBid * currencies[currency].values.irr);
                                                });

                                                var hottestBidOtherCurrency = math.round(auction.lots[lotId].hottestBid * currencies[currency].values.usd);
                                                console.log(hottestBidOtherCurrency);
                                                var clockOther = $('#hottest_bid_other_currency').FlipClock(hottestBidOtherCurrency, {
                                                    clockFace: 'Counter',
                                                    autoStart: false,
                                                    autoPlay: false,
                                                    minimumDigits: 1
                                                });
                                                setInterval(function () {
                                                    clockOther.setTime("$" + hottestBidOtherCurrency);
                                                });


                                            }



                                        });
                                        var queueLots = [];
                                        var latestOrder = $scope.onFireLot ._order;
                                        angular.forEach(auction.lots, function (lot, lotId) {
                                            if (lot._order > latestOrder) {
                                                // console.log(lot._order);
                                                if (queueLots.length > 2) {
                                                    console.log('bishtar az 3');
                                                    return false;
                                                }
                                                console.log('push');
                                                    queueLots.push(lot);


                                            }


                                            $scope.queueLots = queueLots;
                                            // console.log(queueLots);
                                        });
                                        $scope.bidAmount = '';
                                        $scope.auctionNotifications = [];

                                    }
                                }
                                if(message.action == 'auctionNewBid') {
                                    // $scope.auctionNotifications = [];
                                    var userCurrency = $scope.usercurrency;
                                    // console.log(message.data.newBid.prices[userCurrency]);
                                    var userCurrency = $scope.userCurrency;
                                    $scope.hottestBid = message.data.newBid.prices.irr;
                                    $scope.hottestBidOtherCurrency = message.data.newBid.prices.usd;
                                    var clock = $('#hottest_bid').FlipClock(message.data.newBid.prices.irr, {
                                        clockFace: 'Counter',
                                        autoStart: false,
                                        autoPlay: false,
                                        minimumDigits: 1
                                    });
                                        setInterval(function () {
                                            clock.setTime("﷼" + message.data.newBid.prices.irr);
                                        });


                                    var clock2 = $('#hottest_bid_other_currency').FlipClock(message.data.newBid.prices.usd, {
                                        clockFace: 'Counter',
                                        autoStart: false,
                                        autoPlay: false,
                                        minimumDigits: 1
                                    });
                                        setInterval(function () {
                                            clock2.setTime("$" + message.data.newBid.prices.usd);
                                        });



                                        // $scope.hottestBid = math.round(message.data.newBid.prices[userCurrency]);


                                    var auctionNotification = "A new bid offered.";

                                    if (typeof message.data.newBid.bidder === 'object') {
                                        auctionNotification = message.data.newBid.bidder.user.firstName + " " + message.data.newBid.bidder.user.lastName + " offered a new bid.";
                                    }

                                    // console.log($scope.auctionNotifications);
                                }
                                $scope.notification = true;


                                $scope.auctionNotifications.push(auctionNotification);


                            });
                        });
                        $scope.loading = false;
                        $scope.showCurrency = true;
                        var id = $routeParams.id;
                        var auction =  response.data.auction;
                        $scope.auction =  auction;
                        var onFireLot = auction.lots[auction.currentLotId];
                        console.log(onFireLot);
                        $scope.onFireLot = onFireLot;

                        var queueLots = [];
                        var latestOrder = onFireLot._order;
                        angular.forEach(auction.lots, function (lot, lotId) {
                            if (lot._order > latestOrder) {
                                if (queueLots.length > 2) {
                                    console.log('bishtar az 3');

                                    return false;
                                }
                                console.log('pusj');
                                console.log(queueLots.length );
                                queueLots.push(lot);


                            }

                            $scope.queueLots = queueLots;
                        });

                        var hottestBid = onFireLot.hottestBid;
                        $scope.hottestBid = hottestBid* $scope.currencies[currency].values.irr;
                        $scope.hottestBidOtherCurrency = math.round(hottestBid * $scope.currencies[currency].values.usd);
                        var clock = $('#hottest_bid').FlipClock($scope.hottestBid , {
                            clockFace: 'Counter',
                            autoStart: false,
                            autoPlay: false,
                            minimumDigits: 4
                        });
                        setInterval(function () {
                            clock.setTime("﷼" + $scope.hottestBid  );
                        });

                       var clock2 = $('#hottest_bid_other_currency').FlipClock(hottestBid * $scope.currencies[currency].values.usd, {
                            clockFace: 'Counter',
                            autoStart: false,
                            autoPlay: false,
                            minimumDigits: 2
                        });
                        // console.log(hottestBid * $scope.currencies['toman'].values.irr);
                        var hottestBidOtherCurrency = math.round(hottestBid * $scope.currencies['toman'].values.usd);
                        setInterval(function () {
                            clock2.setTime("$" + hottestBidOtherCurrency);
                        });


                        // $scope.hottestBidOtherCurrency = hottestBid * currencies[currency].values[userCurrency];
                    })

            }, function(reason) {
                alert('Failed: ' + reason);
            })
                .catch(handleErrors)


            var handleErrors = function(response) {
            }

            Auction.show($routeParams.id)
                .success(function(auction) {
                    $scope.auction = auction;
                })
                .catch(handleErrors);


            $scope.request_to_bid = function () {
                //
                // if($scope.showBid = true ) {
                //     $scope.showBid = false;
                //     return false;
                // }
                var user = $cookies.get('user');

                if (typeof user == 'undefined') {
                    $scope.showModal = false;
                    $scope.showModal = true;

                    return false;
                }

                var promise = Auction.requestBid($routeParams.id, user)
                promise.then(function (response) {
                    if (response.tag == 'youHaveAlreadyRequested') {
                        Auction.canBid($routeParams.id, user)
                            .success(function (response) {
                                if (response.status == 'ok') {
                                    $scope.showBid = true;
                                    // console.log($scope.showBid);
                                    $scope.showRequestButton = false;
                                } else {
                                    $scope.showalert = true;
                                    $scope.alertMessage = response.message;
                                }
                            })
                    }
                    else {
                        $scope.showalert = true;
                        $scope.alertMessage = response.message;
                    }
                });
            }

            $scope.BidRequest = function (request) {

                var bidAmount = request.bidAmount;
                var user = $cookies.get('user');
                if (typeof user == 'undefined') {
                    $scope.showModal = false;
                    $scope.buttonClicked = "";
                    $scope.showModal = !$scope.showModal;

                    return false;
                }

                Auction.NewBid($routeParams.id, user,$scope.onFireLot.lotId,request.bidAmount,$scope.showBidderIdentity)
                    .success(function (response) {
                        if(response.data.status == 'ok' && response.data.tag == 'bidSaved'){
                            $scope.notification = true;
                            $scope.hottestBid = request.bidAmount;
                            $('#hottest_bid').FlipClock(hottestBid, {
                                clockFace: 'Counter',
                                autoStart: false,
                                autoPlay: false,
                                minimumDigits: 4
                            });
                            var hottestBid = request.bidAmount;

                        } else if(response.data.status == 'fail') {
                            $scope.showalert = true;
                            $scope.alertMessage = response.message;

                        }

                    });
            }
        }]);


