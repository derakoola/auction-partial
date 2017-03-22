<section class="cover-page">
    <h4>Contact</h4>
</section>
<div class="breadcrumb">
    <div class="container">
        <ol>
            <li><a href="" title="">{{ trans('web_v1.home') }}</a></li>
            <li class="active">{{ trans('web_v1.contactUs') }}</li>
        </ol>
    </div>
</div>
<section class="default">
    <nav>
        <div class="container">
            <ul>
                <li><a href="" title="">{{ trans('web_v1.aboutUs') }}</a></li>
                <li class="active"><a href="" title="">{{ trans('web_v1.contactUs') }}</a></li>
                <li><a href="" title="">{{ trans('contact.privacy') }}</a></li>
                <li><a href="" title="">{{ trans('contact.copyright') }}</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <div class="map"><div id="google"></div></div>
            </div>
            <div class="col-xs-12 col-sm-5">
                <div class="contacts">
                    <h5>{{ trans('contact.address') }}</h5>
                    <address>{{trans('contact.addressText')}}</address>
                    <ul>
                        <li>{{trans('contact.phone')}}<span>+982188536278</span></li>
                        <li>{{trans('contact.fax')}}<span>+982188534147</span></li>
                        <li>{{trans('contact.email')}}<span>info@arthibition.net</span></li>
                    </ul>
                    <p>{{trans('contact.secondAddressText')}}</p>
                    <div class="morph-button morph-button-modal morph-button-modal-1 morph-button-fixed">
                        <button type="button" class="button button--aylen">{{trans('contact.feedbackFormButton')}}</button>
                        <div class="morph-content">
                            <div>
                                <div class="content-style-text">
                                    <span class="icon icon-close">Close the dialog</span>
                                    <form>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box-input">
                                                    <label>{{trans('contact.name')}}</label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="box-input">
                                                    <label>{{trans('contact.email')}}</label>
                                                    <input type="email" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="box-input">
                                                    <label>{{trans('contact.subject')}}</label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="box-input">
                                                    <label>{{trans('contact.message')}}</label>
                                                    <textarea placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-8">
                                                <div class="capcha">
                                                    <input type="" value="">
                                                    <span>25895</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-4"><button class="button button--aylen" type="button">{{trans('contact.submit')}}</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="message-site">
    <div class="info">
        <h4>{{trans('footer.registerText')}}</h4>
        <a class="button button--aylen" href="" title="">{{trans('footer.registerBtn')}}</a>
    </div>
</section>
@include('front.v1.app.footer')
{{--<script type="text/javascript">--}}
    {{--// When the window has finished loading create our google map below--}}
    {{--google.maps.event.addDomListener(window, 'load', init);--}}

    {{--function init() {--}}
        {{--// Basic options for a simple Google Map--}}
        {{--// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions--}}
        {{--var mapOptions = {--}}
            {{--// How zoomed in you want the map to start at (always required)--}}
            {{--zoom: 16,--}}

            {{--// The latitude and longitude to center the map (always required)--}}
            {{--center: new google.maps.LatLng(35.728332, 51.431867), // New York--}}

            {{--// How you would like to style the map.--}}
            {{--// This is where you would paste any style found on Snazzy Maps.--}}
            {{--styles: [{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}]--}}
        {{--};--}}

        {{--// Get the HTML DOM element that will contain your map--}}
        {{--// We are using a div with id="map" seen below in the <body>--}}
        {{--var mapElement = document.getElementById('google');--}}

        {{--// Create the Google Map using our element and options defined above--}}
        {{--var map = new google.maps.Map(mapElement, mapOptions);--}}

        {{--// Let's also add a marker while we're at it--}}
        {{--var marker = new google.maps.Marker({--}}
            {{--position: new google.maps.LatLng(35.728332, 51.431867),--}}
            {{--map: map,--}}
            {{--title: 'Snazzy!'--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}
</main>

<script type="text/javascript">
    (function() {
        var docElem = window.document.documentElement, didScroll, scrollPosition;

        // trick to prevent scrolling when opening/closing button
        function noScrollFn() {
            window.scrollTo( scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0 );
        }

        function noScroll() {
            window.removeEventListener( 'scroll', scrollHandler );
            window.addEventListener( 'scroll', noScrollFn );
        }

        function scrollFn() {
            window.addEventListener( 'scroll', scrollHandler );
        }

        function canScroll() {
            window.removeEventListener( 'scroll', noScrollFn );
            scrollFn();
        }

        function scrollHandler() {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( function() { scrollPage(); }, 60 );
            }
        };

        function scrollPage() {
            scrollPosition = { x : window.pageXOffset || docElem.scrollLeft, y : window.pageYOffset || docElem.scrollTop };
            didScroll = false;
        };

        scrollFn();

        var UIBtnn = new UIMorphingButton( document.querySelector( '.morph-button' ), {
            closeEl : '.icon-close',
            onBeforeOpen : function() {
                // don't allow to scroll
                noScroll();
            },
            onAfterOpen : function() {
                // can scroll again
                canScroll();
            },
            onBeforeClose : function() {
                // don't allow to scroll
                noScroll();
            },
            onAfterClose : function() {
                // can scroll again
                canScroll();
            }
        } );

        document.getElementById( 'terms' ).addEventListener( 'change', function() {
            UIBtnn.toggle();
        } );
    })();
</script>

