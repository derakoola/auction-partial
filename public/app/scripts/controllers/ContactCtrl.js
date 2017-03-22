angular.module('ContactCtrl', ['contactService'])

    .controller('ContactCtrl',
        ['$scope', 'Contact', function($scope, Contact) {

            $scope.contact = function() {
                Contact.show($scope.user);
            };

        }]);