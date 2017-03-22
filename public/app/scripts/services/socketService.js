angular.module('socketService', [])

.factory('socketIo',['socketFactory','$rootScope','$window', function (socketFactory, $rootScope, $window) {


    return {
        init: function(socketInfo) {
            $window.socket = io(socketInfo.host + ':' + socketInfo.port, {
                query: "channel=" + socketInfo.channel,
                'force new connection': true
            });
            return $window.socket;
         },

        on:function (eventName, callback) {
            socket.on(eventName, function () {
                var args = arguments;
                $rootScope.$apply(function () {
                    callback.apply(socket, args);

                });
            });
        },
        emit: function (eventName, data, callback) {
            socket.emit(eventName, data, function () {
                var args = arguments;
                $rootScope.$apply(function () {
                    if (callback) {
                        callback.apply(socket, args);
                    }
                });
            })
        }
    };
}]);