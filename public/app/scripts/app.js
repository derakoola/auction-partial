var auctionApp = angular.module('auctionApp', [
    'ngRoute',
    'ngCookies',
    'btford.socket-io',
    'HomeCtrl',
    'categoryService',
    'auctionService',
    'AuctionsCtrl',
    'AuctionCtrl',
    'AuctionManageCtrl',
    'AuctionDetailCtrl',
    'AuctionAppCtrl',
    'AuthCtrl',
    'authService',
    'currencyService',
    'localeService',
    'socketService',
],  function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).constant("CSRF_TOKEN", '{!! csrf_token() !!}');

auctionApp.config([
    '$routeProvider', function($routeProvider) {
        $routeProvider

            .when('/', {
                templateUrl: locale + '/home',
                controller: 'HomeCtrl'
            })

            .when('/auctions', {
            templateUrl : locale + '/auctions',
            controller  : 'AuctionsCtrl'
            })

            .when('/auction/details/:id',{
                templateUrl: function(params){
                    return locale + '/auction/detail/' + params.id;
                },
                controller  : 'AuctionDetailCtrl'
            })

            .when('/auction/:id',{
                templateUrl: function(params){
                    return locale + '/auction/' + params.id;
                },
                controller  : 'AuctionCtrl'
            })
            .when('/auction/manage/:id',{
                templateUrl: function(params){
                    return locale + '/auction/manage/' + params.id;
                },
                controller  : 'AuctionCtrl'
            })

            .when('/login',{
                templateUrl : locale + '/login',
                controller  : 'AuthCtrl'
            })

            .when('/contact',{
                templateUrl : locale + '/contact',
            })
            .when('/about',{
                templateUrl : locale + '/about',
            });

    }
]);


auctionApp.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});

auctionApp.directive('modal', function () {
    return {
        template: '<div class="modal fade">' +
        '<div class="modal-dialog">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
        '</div>' +
        '<div class="modal-body" ng-transclude></div>' +
        '</div>' +
        '</div>' +
        '</div>',
        restrict: 'E',
        transclude: true,
        replace:true,
        scope:true,
        link: function postLink(scope, element, attrs) {
            scope.$watch(attrs.visible, function(value){
                if(value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });

            $(element).on('shown.bs.modal', function(){
                scope.$apply(function(){
                    scope.$parent[attrs.visible] = true;
                });
            });

            $(element).on('hidden.bs.modal', function(){
                scope.$apply(function(){
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});





auctionApp.directive('alert', function () {
    return {
        template: '<div class="modal fade full-modal" id="message-system" tabindex="-1" role="dialog">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
        '</div>' +
        '<div class="modal-body" ng-transclude></div>' +
        '</div>' +
        '</div>' +
        '</div>',
        restrict: 'E',
        transclude: true,
        replace:true,
        scope:true,
        link: function postLink(scope, element, attrs) {
            scope.$watch(attrs.visible, function(value){
                if(value == true)
                    $(element).modal('show');
                else
                    $(element).modal('hide');
            });

            $(element).on('shown.bs.modal', function(){
                scope.$apply(function(){
                    scope.$parent[attrs.visible] = true;
                });
            });

            $(element).on('hidden.bs.modal', function(){
                scope.$apply(function(){
                    scope.$parent[attrs.visible] = false;
                });
            });
        }
    };
});
