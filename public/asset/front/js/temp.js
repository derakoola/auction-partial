$(document).ready(function () {

    locale = '{{ app()->getLocale() }}';
    currency = '{{ session('currency','usd') }}';

    currencies = {};
    $.ajax({
            xhrFields: {withCredentials: true},
            type: "POST",
            url: '{{ url('api/v1/currency/index') }}',
        dataType: "JSON",
        cache: false,
        success: function (response) {
        currencies = response.data.currencies;
    },
    error: function (xhr, ajaxOptions, thrownError) {
    }
}).then(function () {
        $.ajax({
                xhrFields: {withCredentials: true},
                type: "POST",
                url: '{{ url('api/v1/auction/join/'.$id) }}',
            dataType: "JSON",
            cache: false,
            ok: function (response) {

            console.log(response);

            if (response.status != 'ok') {
                $('div#container').append('<p class="alert alert-danger">' + response.message + '</p>');
                return false;
            }

            var socketInfo = response.data.socket;


            $('h3#auction_info').html(auction.title[locale] + "<br>" + auction.description[locale]);

            onFireLot = auction.lots[auction.currentLotId];
            $('div#on_fire_lot').html(onFireLot.title[locale] + "<br>" + onFireLot.description[locale]);
            $('img#preview_on_fire_lot').attr('src', '{{ url('/') }}/' + onFireLot.media.image.mediaPath);


            hottestBid = onFireLot.hottestBid;
            $('#hottest_bid').FlipClock(hottestBid, {
                clockFace: 'Counter',
                autoStart: false,
                autoPlay: false,
                minimumDigits: 6
            });
            if (currency != 'usd') {
                $('div#hottest_bid_other_currency').FlipClock(onFireLot.hottestBid * currencies[currency].value, {
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

            console.log(queueLots);

            $('div#queue_lots').html('');
            $.each(queueLots, function (key, lot) {
                var media = '{{ url('/') }}/' + lot.media.image.mediaPath;
                $('div#queue_lots').append('<div class="queue_lots_holder"><img src="' + media + '" alt="lot title" class="queue_lots_tn img-responsive img-thumbnail"><div class="info_queue_lots"><img class="img-responsive" src="' + media + '"><span><strong>' + lot._order + ':</strong> ' + lot.title[locale] + ' </span></div></div>');
            });


            var socket = io.connect(socketInfo.host + ':' + socketInfo.port, {
                query: "channel=" + socketInfo.channel,
                'force new connection': true
            });

            socket.on("connect", function (data) {
                socket.on("message", function (data) {
                    var dataObject = jQuery.parseJSON(data);

                    if (dataObject.tag == "newBidPublished") {

                        console.log(dataObject);
                        hottestBid = dataObject.data.newBid.prices.usd;

                        $('#hottest_bid').FlipClock(hottestBid, {
                            clockFace: 'Counter',
                            autoStart: false,
                            autoPlay: false,
                            minimumDigits: 6
                        });
                        if (currency != 'usd') {
                            $('div#hottest_bid_other_currency').FlipClock(hottestBid * currencies[currency].value, {
                                clockFace: 'Counter',
                                autoStart: false,
                                autoPlay: false,
                                minimumDigits: 6
                            });
                        }

                        $('button#request_to_bid').parent().append("<input value='" + hottestBid + "' id='new_bid' class='new_bid form-control' type='text'>");

                        $('#notifications').append('<div class="alert alert-warning"><p>{{ trans('all.newBidAccepted') }}</p></div>');
                    }

                });
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            responseObject = $.parseJSON(xhr.responseText)
            $('div#container').append('<p class="alert alert-danger">' + response.message + '</p>');
        }
    });
    });


    $('select#language_changer').change(function () {
        var href = window.location.href;
        href = href.replace("/" + locale + "/", "/" + $(this).val() + "/");
        window.location.href = href;
        return false;
    });


    $('select#currency_changer').change(function () {
        window.location.href = '{{ url('/') }}/' + locale + '/currency/change/' + $(this).val();
        return false;
    });


    $('button#request_to_bid').click(function () {

        user = $.cookie('user');
        if (typeof user == 'undefined') {
            alert('login first...');
            return false;
        }

        $.ajax({
                xhrFields: {withCredentials: true},
                type: "POST",
                url: '{{ url('api/v1/auction/request-to-bid') }}/' + auction.auctionId + '?token=' + user,
            dataType: "JSON",
            cache: false,
            success: function (response) {

            continueProcess = true;
            if (response.status == 'ok') {
                continueProcess = false;
                alert(response.message);
                return true;
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('error');
        }
    }).then(function () {
            if (!continueProcess) {
                return false;
            }

            $.ajax({
                    xhrFields: {withCredentials: true},
                    type: "POST",
                    url: '{{ url('api/v1/auction/can-bid') }}/' + auction.auctionId + '?token=' + user,
                dataType: "JSON",
                cache: false,
                success: function (response) {
                if (response.status != 'ok') {
                    alert(response.message);
                    return false;
                }

                $('button#request_to_bid').parent().append("<input value='" + hottestBid + "' id='new_bid' class='new_bid form-control' type='text'>");
                $('button#request_to_bid').remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('error');
            }
        });

        });
    });


    $(document).on('keypress', 'input#new_bid', function (evt) {
        if (evt.which == 13) {

            $.ajax({
                    xhrFields: {withCredentials: true},
                    type: "POST",
                    url: '{{ url('api/v1/auction/new-bid') }}/' + auction.auctionId + '?token=' + user,
                dataType: "JSON",
                data: {
                lotId: onFireLot.lotId,
                    bidAmount: $(this).val(),
                    currency: currency,
                    showBidderIdentity: "yes"
            },
            cache: false,
                success: function (response) {
                alert(response.message);
                if (response.status != 'ok') {
                    alert(response.message);
                    return false;
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('error');
            }
        });
        }
    });

});