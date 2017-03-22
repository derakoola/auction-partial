angular.module('AuthCtrl', ['authService'])

.controller('AuthCtrl',
    ['$scope', 'Auth', function($scope, Auth) {

        $scope.login = function() {
            Auth.login($scope.user);
        };

        $scope.register = function() {
            Auth.register($scope.user);
        };

    }]);