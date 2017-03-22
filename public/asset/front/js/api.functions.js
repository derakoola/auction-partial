var apiBaseUrl = window.location.protocol + "//" + window.location.host + "/api_web/public/";

function getCurrencies() {
    var deferred = $.Deferred();
    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: apiBaseUrl + "api/v1/currency/index",
        dataType: "JSON",
        cache: false,
        success: function (response) {
            if (response.status == 'ok') {
                deferred.resolve(response.data.currencies);
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


function getLocales() {
    var deferred = $.Deferred();
    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: apiBaseUrl + "api/v1/locale/index",
        dataType: "JSON",
        cache: false,
        success: function (response) {

            if (response.status == 'ok') {
                deferred.resolve(response.data.locales);
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


function getAuction(auctionId, user) {
    var deferred = $.Deferred();

    var url = apiBaseUrl + "api/v1/auction/join/" + auctionId;
    if (typeof user !== 'undefined') {
        url += "?token=" + user;
    }

    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: url,
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


function requestToBid(auctionId, user) {

    var deferred = $.Deferred();
    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: apiBaseUrl + "api/v1/auction/request-to-bid/" + auctionId + "?token=" + user,
        dataType: "JSON",
        cache: false,
        success: function (response) {

            if (response.status == 'ok') {
                deferred.resolve(response);
            } else {
                deferred.reject(response);
            }
        },
        error: function (req, status, error) {
            var errorMessage = (error.message) ? error.message : error;
            deferred.reject(errorMessage);
        }
    });

    return deferred.promise();
}

function canBid(auctionId, user) {

    var deferred = $.Deferred();
    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: apiBaseUrl + "api/v1/auction/can-bid/" + auctionId + "?token=" + user,
        dataType: "JSON",
        cache: false,
        success: function (response) {

            if (response.status == 'ok') {
                deferred.resolve(response);
            } else {
                deferred.reject(response);
            }
        },
        error: function (req, status, error) {
            var errorMessage = (error.message) ? error.message : error;
            deferred.reject(errorMessage);
        }
    });

    return deferred.promise();
}


function newBid(auctionId, user, lotId, bidAmount, showBidderIdentity) {

    var deferred = $.Deferred();
    $.ajax({
        xhrFields: {withCredentials: true},
        type: "POST",
        url: apiBaseUrl + "api/v1/auction/new-bid/" + auctionId + "?token=" + user,
        dataType: "JSON",
        cache: false,
        data: {
            lotId: lotId,
            bidAmount: bidAmount,
            showBidderIdentity: showBidderIdentity
        },
        success: function (response) {

            if (response.status == 'ok') {
                deferred.resolve(response);
            } else {
                deferred.reject(response);
            }
        },
        error: function (req, status, error) {
            var errorMessage = (error.message) ? error.message : error;
            deferred.reject(errorMessage);
        }
    });

    return deferred.promise();
}
