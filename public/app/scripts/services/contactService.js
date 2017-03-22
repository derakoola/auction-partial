angular.module('contactService', [])

    .factory('Contact', function() {
            return {
                show: function() {
                    return $http.get('api/v1/contact');

                },
            };
        });
