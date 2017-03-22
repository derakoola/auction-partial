angular.module('auctionService', ['ngCookies'])

    .factory('Auction', ['$http','$q','$cookies','$cookieStore', function($http,$q, $cookies,$cookieStore) {

        return {
            getAll: function() {
                return $http.post('api/v1/auction/index', {
                    headers: {
                        'Cache-Control' : 'no-cache',
                        'Content-type': 'application/json'
                    },
                    type: 'live',
                    status: 'onFire'
                });

            },
            show: function(id) {
                return $http.get(locale + '/auction/' + id);
            },
            details: function(id) {
                return $http.get(locale + '/auction/' + id);
            },
            create: function(auction) {
                return $http.post('auctions', auction);
            },
            requestBid: function (id, user) {
                var self= this;
                var deferred = $q.defer();

                 $http.post('api/v1/auction/request-to-bid/' + id + '?token=' + user , {
                    headers: {
                        'Cache-Control': 'no-cache',
                        'Content-type': 'application/json'
                    }
                })
                .success(function (response) {
                    // if (response.status == 'ok') {
                        self.canBid(id,user)
                        deferred.resolve(response);
                    // }
                    // else {
                    //     deferred.reject(response);
                    // }
                })
                .error(function (req, status, error) {
                    var errorMessage = (error.message) ? error.message : error;
                    deferred.reject(errorMessage);
                })

            return deferred.promise;

            },
            join: function (id) {

                 return $http.post('api/v1/auction/join/' + id,{
                    headers: {
                        'Cache-Control' : 'no-cache',
                        'Content-type': 'application/json'
                    }
                })


            },
            nextStage: function(auctionId, user) {
                return $http.post('api/v1/auction/next-stage/' + auctionId  + '?token=' + user,{
                    headers: {
                        'Cache-Control' : 'no-cache',
                        'Content-type': 'application/json'
                    }
                })
            },

            canBid: function (auctionId, user) {
                 return $http.post('api/v1/auction/can-bid/' + auctionId + '?token=' + user,{
                    headers: {
                        'Cache-Control' : 'no-cache',
                        'Content-type': 'application/json'
                    }
                })
                  

            },
            NewBid: function (auctionId, user, lotId, bidAmount, showBidderIdentity) {
                return $http({
                    method : 'POST',
                    url : 'api/v1/auction/new-bid/' + auctionId + '?token=' + user,
                    data : {
                        lotId: lotId,
                        bidAmount: bidAmount,
                        showBidderIdentity: showBidderIdentity
                    },
                    headers: {
                        'Cache-Control' : 'no-cache',
                        'Content-type': 'application/json'
                    },
                })
               


            }

    }

    }]);