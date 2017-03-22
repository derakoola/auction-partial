
angular.module('AuctionAppCtrl', [])
    .controller('AuctionAppCtrl', ['$scope','$cookies', function ($scope,$cookies) {
        $scope.locale = locale;
        $scope.rtl = locale;

        $scope.currency = currency;
        // $scope.usercurrency = usercurrency;
        $cookies.put('user', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI1ODA2MjQ1M2UxMzgyMzAzNjc2YjAyMTgiLCJpc3MiOiJodHRwOlwvXC8xOTkuMjAxLjEyMy4yMjhcL2FwaV93ZWJcL3B1YmxpY1wvYXBpXC92MVwvdXNlclwvbG9naW4iLCJpYXQiOjE0NzY4ODI4MDAsImV4cCI6MTY5NDYwNzIwMCwibmJmIjoxNDc2ODgyODAwLCJqdGkiOiJkNjg1NjI2M2VkN2EyNDhhMDlmMjUyOTQ0MTY0YTEyZSJ9.dg6WUGnRhiSZhNq31OXtvjpvpG1n1ludQStUn27OPCk');
    //
        $scope.locale_change = function (lang) {
            console.log(lang);

            $scope.rtl = lang;

        }

        var user = $cookies.get('user');
        if (typeof user == 'undefined') {
            $scope.NotLoggedIn = true;
        }
        else {
            $scope.NotLoggedIn = false;

        }

        $scope.showLogin = function () {
            // console.log(showModal);
            var user = $cookies.get('user');
            if (typeof user == 'undefined') {
                $scope.showModal = false;
                $scope.showModal = true;
                return false;
            }
        }
        $scope.showModalRegister = function () {
            // console.log(showRegister);
            var user = $cookies.get('user');
            if (typeof user == 'undefined') {
                $scope.showRegister = false;
                $scope.showRegister = true;
                return false;
            }
        }

    }]);
