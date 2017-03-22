angular.module('authService', [])

.factory('Auth',['$cookies',
        function($cookies) {
            return {
                login: function() {
                    return $http.post('api/v1/auction/index');

                },
                register : function(user) {
                    auth.$createUserWithEmailAndPassword({
                        email    : user.email,
                        password : user.password
                    }).success(function(regUser) {
                        $rootScope.message = "Hello " + user.firstname + ", Thank you for registration.";
                    }).catch(function(error) {
                        $rootScope.message = error.message;
                    });
                } // register
            };
        }
    ]);
