var apiBaseUrl = window.location.protocol + "//" + window.location.host + "/api_web/public/";

function manageAuction(socketInfo, auction, currencies, locales, userCurrency, userLocale) {
    var socket = io.connect(socketInfo.host + ':' + socketInfo.port, {
        query: "channel=" + socketInfo.channel,
        'force new connection': true
    });

    socket.on("connect", function () {
        socket.on("message", function (message) {
            message = jQuery.parseJSON(message);
            window[message.data.type + "SocketManageMessage"](message, auction, currencies, locales, userCurrency, userLocale);
            return true;
        });
    });
}


function nextStage(auctionId, user) {

    var deferred = $.Deferred();

    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: apiBaseUrl + "api/v1/auction/next-stage/" + auctionId + "?token=" + user,
        dataType: "JSON",
        cache: false,
        success: function (response) {
            if (response.status == 'ok') {
                deferred.resolve(response.data);
            } else {
                deferred.reject(response.message);
            }
        },
        error: function (req, status, error) {
            var errorMessage = (error.message) ? error.message : error;
            deferred.reject(errorMessage);
        }
    });

    return deferred.promise();
}
