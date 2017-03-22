
angular.module('AuctionsCtrl', ['auctionService'])

    .controller('AuctionsCtrl',['$scope' ,'Auction', function($scope, Auction) {
        $scope.locale = locale;

        $scope.filterlocal = function(items) {
            var result = {};
            angular.forEach(items, function(value, key) {
                if (key == locale) {
                    result[key] = value;
                }
            });
            return result;
        }

        $scope.loading = true;


        var AuctionsLoaded = function(Auctions) {
            $scope.auctions = response.data.data.auctions;
        }

        var handleErrors = function(response) {
            console.error(response);
        }


        var Promise = Auction.getAll()
            .success(function (response) {
                console.log(response);
                if(response.status != 'ok') {
                    alert(response.message);
                    return false;
                } else {
                    $scope.loading = false;
                    $scope.auctions = response.data.auctions;
                    $scope.locale = locale;
                }
            })
    	.catch(handleErrors);
    }]);