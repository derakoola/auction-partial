function updateLiveAuctionTemplate(auction, currencies, locales, userCurrency, userLocale) {

    // update currencies
    $('select#currency_changer').html('');
    $.each(currencies, function (key, value) {
        var selected = '';
        if (key == userCurrency) {
            selected = 'selected';
        }
        $('select#currency_changer').append("<option " + selected + " value='" + key + "'>" + value.title + "</option>");
    });

    // update locales
    $('select#language_changer').html('');
    $.each(locales, function (key, value) {
        var selected = '';
        if (key == userLocale) {
            selected = 'selected';
        }
        $('select#language_changer').append("<option " + selected + " value='" + key + "'>" + value.native + "</option>");
    });


    $('h3#auction_info').html(auction.title[userLocale] + "<br>" + auction.description[userLocale]);

    window.onFireLot = auction.lots[auction.currentLotId];
    $('div#on_fire_lot').html(onFireLot.title[userLocale] + "<br>" + onFireLot.description[userLocale]);
    $('img#preview_on_fire_lot').attr('src', apiBaseUrl + onFireLot.media.image.mediaPath);


    hottestBid = onFireLot.hottestBid;
    $('#hottest_bid').FlipClock(hottestBid, {
        clockFace: 'Counter',
        autoStart: false,
        autoPlay: false,
        minimumDigits: 6
    });
    if (userCurrency != auction.currency) {
        $('div#hottest_bid_other_currency').FlipClock(onFireLot.hottestBid * currencies[auction.currency].values[userCurrency], {
            clockFace: 'Counter',
            autoStart: false,
            autoPlay: false,
            minimumDigits: 6
        });
    }


    var queueLots = [];
    var latestOrder = onFireLot._order;
    $.each(auction.lots, function (lotId, lot) {
        if (lot._order > latestOrder) {
            queueLots.push(lot);
        }

        if (queueLots.length > 4) {
            return false;
        }

    });

    $('div#queue_lots').html('');
    $.each(queueLots, function (key, lot) {
        var media = apiBaseUrl + lot.media.image.mediaPath;
        $('div#queue_lots').append('<div class="queue_lots_holder"><img src="' + media + '" alt="lot title" class="queue_lots_tn img-responsive img-thumbnail"><div class="info_queue_lots"><img class="img-responsive" src="' + media + '"><span><strong>' + lot._order + ':</strong> ' + lot.title[userLocale] + ' </span></div></div>');
    });
}


function joinToAuction(socketInfo, auction, currencies, locales, userCurrency, userLocale) {
    var socket = io.connect(socketInfo.host + ':' + socketInfo.port, {
        query: "channel=" + socketInfo.channel,
        'force new connection': true
    });

    socket.on("connect", function () {
        socket.on("message", function (message) {
            message = jQuery.parseJSON(message);
            console.log(message.data.type + "SocketMessage");
            window[message.data.type + "SocketMessage"](message, auction, currencies, locales, userCurrency, userLocale);
            return true;
        });
    });
}


function newBidSocketMessage(message, auction, currencies, locales, userCurrency, userLocale) {

    var hottestBid = message.data['newBid'];

    $('#hottest_bid').FlipClock(hottestBid.prices[auction.currency], {
        clockFace: 'Counter',
        autoStart: false,
        autoPlay: false,
        minimumDigits: 6
    });
    if (window.userCurrency != auction.currency) {
        $('div#hottest_bid_other_currency').FlipClock(hottestBid.prices[window.userCurrency], {
            clockFace: 'Counter',
            autoStart: false,
            autoPlay: false,
            minimumDigits: 6
        });
    }

    $('input#new_bid').val(hottestBid.prices[auction.currency]);

    var auctionNotification = "A new bid offered.";
    if (typeof message.data.newBid.bidder === 'object') {
        auctionNotification = message.data.newBid.bidder.user.firstName + " " + message.data.newBid.bidder.user.lastName + " offered a new bid.";
    }

    $('#notifications').append('<div class="alert alert-warning"><p>' + auctionNotification + '</p></div>');

    return true;
}


function showBidForm(hottestBid) {
    $('button#request_to_bid').parent().append("<input value='" + hottestBid + "' id='new_bid' class='new_bid form-control' type='text'>");
    $('button#request_to_bid').parent().append("<input id='show-bidder-identity' class='form-control' type='checkbox'>");
}


function nextStageSocketMessage(message, auction, currencies, locales, userCurrency, userLocale) {
    var stage = message.data[message.data.type]
    $('#notifications').append('<div class="alert alert-warning"><p>' + stage.stage + '</p></div>');
}

function nextLotSocketMessage(message, auction, currencies, locales, userCurrency, userLocale) {
    $('#notifications').append('<div class="alert alert-success"><p>Sold</p></div>');

    onFireLot = auction.lots[auction.currentLotId];
    $.each(auction.lots, function (lotId, lot) {
        if (lot._order == (onFireLot._order + 1)) {
            auction.currentLotId = lotId;
            return true;
        }
    });

    updateLiveAuctionTemplate(auction, currencies, locales, userCurrency, userLocale);
}
