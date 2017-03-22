angular.module('HomeCtrl', ['categoryService'])

    .controller('HomeCtrl',
        ['$scope', 'Category', function($scope, Category) {


            var promise = Category.getAll()
            promise.then(function (response) {
                $scope.categories = response.categories;
                $scope.locale = locale;

                console.log(locale);
            })

        }]);