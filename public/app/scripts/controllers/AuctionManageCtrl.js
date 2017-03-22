
angular.module('AuctionManageCtrl', ['auctionService', 'currencyService','socketService'])

    .controller('AuctionManageCtrl',['$scope' ,'Auction','socketIo','Currency','Locale', '$routeParams','$location','$cookies','$rootScope',
        function($scope,Auction,socketIo,Currency,Locale, $routeParams, $location, $cookies,$rootScope) {
            $scope.locale = locale;
            $scope.currency = currency;
            $scope.showRequestButton = true;
            var userCurrency = $cookies.get('userCurrency');
            if(!userCurrency) {
                var userCurrency = 'irr';
            }


            $scope.userCurrency = userCurrency;
            $scope.loading = true;
            $scope.id = $routeParams.id;
            var user = $cookies.get('user');

            $scope.changeLanguage = function (lang) {
                // $window.location = lang + '/#/api_web/public/fa/auction/' + $routeParams.id;

            }
            $scope.currency_change = function (curr) {
                console.log(curr);
                $scope.usercurrency = $cookies.put('userCurrency', curr);
                $('#hottest_bid_other_currency').FlipClock($scope.hottestBid * $scope.currencies[currency].values[curr], {
                    clockFace: 'Counter',
                    autoStart: false,
                    autoPlay: false,
                    minimumDigits: 6
                });
            }
            $scope.bidderIdentity = function (showBidderIdentity) {
                var showBidderIdentity = showBidderIdentity;
                $scope.showBidderIdentity = showBidderIdentity;
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
                Auction.nextStage($routeParams.id, user)
                    .then(function (response) {
                        // console.log(response);
                    })
            }
            var promise = Currency.getAll()
            promise.then(function (response) {
                var currencies = response;
                $scope.currencies = currencies;
                Auction.join($routeParams.id)
                    .then(function (response) {
                        $scope.auctionNotifications = [];

                    $scope.socket = response.data.data.socket;
                        socketIo.init(response.data.data.socket)
                        socketIo.on("connect", function () {
                            socketIo.on("message", function (message) {
                                message = JSON.parse(message);
                                console.log(message);
                                if(message.data.nextStage) {
                                    var auctionNotification = message.data.nextStage.stage;

                                }
                                else {
                                    var auctionNotification = 'Sold';

                                }
                                
                                $scope.notification = true;
                                $scope.auctionNotifications.push(auctionNotification);

                            });
                        });
                        $scope.loading = false;
                        $scope.showCurrency = true;
                        var id = $routeParams.id;
                        var auction =  response.data.data.auction;
                        $scope.auction =  auction;
                        var onFireLot = auction.lots[auction.currentLotId];
                        $scope.onFireLot = onFireLot;

                        var queueLots = [];
                        var latestOrder = onFireLot._order;
                        angular.forEach(auction.lots, function (lot, lotId) {
                            if (lot._order > latestOrder) {
                                queueLots.push(lot);
                            }

                            if (queueLots.length > 4) {
                                return false;
                            }
                            $scope.queueLots = queueLots;
                        });

                        var hottestBid = onFireLot.hottestBid;
                        $scope.hottestBid = hottestBid;
                        $('#hottest_bid').FlipClock(hottestBid, {
                            clockFace: 'Counter',
                            autoStart: false,
                            autoPlay: false,
                            minimumDigits: 6
                        });
                        $('#hottest_bid_other_currency').FlipClock(hottestBid * $scope.currencies[currency].values[userCurrency], {
                            clockFace: 'Counter',
                            autoStart: false,
                            autoPlay: false,
                            minimumDigits: 6
                        });
                        // $scope.hottestBidOtherCurrency = hottestBid * currencies[currency].values[userCurrency];
                    })

            }, function(reason) {
                alert('Failed: ' + reason);
            })
                .catch(handleErrors)


            var handleErrors = function(response) {
                console.error(response);
            }

            Auction.show($routeParams.id)
                .then(function(auction) {
                    $scope.auction = auction;
                })
                .catch(handleErrors);


            $scope.request_to_bid = function () {
                if (typeof user == 'undefined') {
                    $scope.showModal = false;
                    $scope.buttonClicked = "";
                    $scope.showModal = !$scope.showModal;

                    return false;
                }

                var promise = Auction.requestBid($routeParams.id, user)
                promise.then(function (response) {
                    if (response.tag == 'youHaveAlreadyRequested') {
                        Auction.canBid($routeParams.id, user)
                            .then(function (response) {
                                if (response.status == 'ok') {
                                    $scope.showBid = true;
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

            $scope.BidRequest = function (bidAmount) {
                console.log(bidAmount);
                var user = $cookies.get('user');
                if (typeof user == 'undefined') {
                    $scope.showModal = false;
                    $scope.buttonClicked = "";
                    $scope.showModal = !$scope.showModal;

                    return false;
                }

                Auction.NewBid($routeParams.id, user,$scope.onFireLot.lotId,bidAmount,$scope.showBidderIdentity)
                    .then(function (response) {
                        console.log(response);
                        if(response.data.status == 'ok' && response.data.tag == 'bidSaved'){
                            $scope.notification = true;
                            $scope.hottestBid = bidAmount;
                            var hottestBid = bidAmount;

                            $('#hottest_bid').FlipClock(hottestBid, {
                                clockFace: 'Counter',
                                autoStart: false,
                                autoPlay: false,
                                minimumDigits: 6
                            });
                        } else {
                            $scope.showalert = true;
                            $scope.alertMessage = response.data.message;

                        }

                    });
            }
        }]);


