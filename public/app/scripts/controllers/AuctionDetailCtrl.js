
angular.module('AuctionDetailCtrl', ['auctionService', 'currencyService'])

    .controller('AuctionDetailCtrl',['$scope' ,'Auction','Currency','Locale', '$routeParams','$location',
        function($scope,Auction,Currency,Locale, $routeParams, $location) {
            Auction.show($routeParams.id)
                .success(function(auction) {
                    $scope.auction = auction;
                })

        }]);


