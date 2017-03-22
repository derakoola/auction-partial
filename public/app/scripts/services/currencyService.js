angular.module('currencyService', [])

    .factory('Currency', ['$http','$q', function($http,$q) {

        return {
            getAll: function() {
                var deferred = $q.defer();

                $http.post('api/v1/currency/index', {
                    headers: {
                        'Cache-Control' : 'no-cache',
                        'Content-type': 'application/json'
                    }
                })
                .success(function (response) {
                    if (response.status == 'ok') {
                        deferred.resolve(response.data.currencies);
                    } else {
                        deferred.reject(response.message);
                    }
                })
                .error(function (req, status, error) {
                    var errorMessage = (error.message) ? error.message : error;
                    deferred.reject(errorMessage);
                })
                return deferred.promise;

            },
            
        }

    }]);