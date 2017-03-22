
@section('title',trans('web_v1.hotAuctions'))

{{--@section('js')--}}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}

            {{--locale = '{{ app()->getLocale() }}';--}}

            {{--$.ajax({--}}
                {{--xhrFields: {withCredentials: true},--}}
                {{--type: "POST",--}}
                {{--url: '{{ url('api/v1/auction/index') }}',--}}
                {{--dataType: "JSON",--}}
                {{--data: {'type': 'live', 'status': 'onFire'},--}}
                {{--cache: false,--}}
                {{--success: function (response) {--}}

                    {{--console.log(response);--}}

                    {{--if (response.status != 'ok') {--}}
                        {{--alert(response.message);--}}
                        {{--return false;--}}
                    {{--}--}}

                    {{--$.each(response.data.auctions, function (index, auction) {--}}

                        {{--var media = '{{ url('/') }}/' + auction.media.image.mediaPath;--}}

                        {{--$('div#auctions').append('<div class="col-xs-6 col-lg-4"><h2>' + auction.title[locale] + '</h2><p>' + auction.description[locale] + '</p><p><img class="img-responsive" alt="' + auction.title[locale] + '" src="' + media + '" /></p><p><a class="btn btn-default" href="{{ url(app()->getLocale().'/auction') }}/' + auction._id + '" role="button">{{ trans('web_v1.goToAuction') }} &raquo;</a></p></div>');--}}
                    {{--});--}}

                {{--},--}}
                {{--error: function (xhr, ajaxOptions, thrownError) {--}}
                    {{--responseObject = $.parseJSON(xhr.responseText)--}}
                    {{--alert(responseObject.message);--}}
                {{--}--}}

            {{--});--}}
        {{--});--}}
    {{--</script>--}}
{{--@endsection--}}



<section class="product-name">
    <h2>{{trans('web_v1.hotAuctions')}}</h2>
</section>
<div class="breadcrumb">
    <div class="container">
        <ol>
            <li><a href="" title="">{{trans('web_v1.home')}}</a></li>
            <li class="active">{{trans('web_v1.hotAuctions')}}</li>
        </ol>
    </div>
</div>

<section class="product-list">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <div class="filter">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Category</h3>
                            <span class="clickable"></span>
                        </div>
                        <div class="panel-body">
                            <ul class="cbox">
                                <li>
                                    <input type="checkbox" name="ca1" id="ca1" />
                                    <label for="ca1">Paintings</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca2" id="ca2" />
                                    <label for="ca2">Prints</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca3" id="ca3" />
                                    <label for="ca3">Sculpture, Statues, Busts & Carvings</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca4" id="ca4" />
                                    <label for="ca4">Watercolors</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca5" id="ca5" />
                                    <label for="ca5">Photography</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca6" id="ca6" />
                                    <label for="ca6">Drawings</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca7" id="ca7" />
                                    <label for="ca7">Mixed Media</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca8" id="ca8" />
                                    <label for="ca8">Scrolls & Fans</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca9" id="ca9" />
                                    <label for="ca9">Tribal and Native American Artifacts</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="ca10" id="ca10" />
                                    <label for="ca10">Textiles</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3>Price range</h3>--}}
                            {{--<span class="clickable"></span>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<input id="ex2" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,750]"/>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3>Creator</h3>--}}
                            {{--<span class="clickable"></span>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<ul class="cbox">--}}
                                {{--<li>--}}
                                    {{--<input type="checkbox" name="cr1" id="cr1" />--}}
                                    {{--<label for="cr1">Andy Warhol</label>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<input type="checkbox" name="cr2" id="cr2" />--}}
                                    {{--<label for="cr2">John James Audubon</label>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<input type="checkbox" name="cr3" id="cr3" />--}}
                                    {{--<label for="cr3">Pablo Picasso</label>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<input type="checkbox" name="cr4" id="cr4" />--}}
                                    {{--<label for="cr4">Richard Marquis</label>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="col-xs-12 col-sm-9">
                <div class="row">
                    <div class="col-xs-12 col-sm-4" ng-repeat="auction in auctions">
                        <div class="pro">
                            <div class="wall">
                                <p ng-repeat="(local,title) in filterlocal(auction.title)">
                                    <img class="img-responsive" alt="<% title %>" src="<% auction.media.image.mediaPath %>">

                                </p>
                            </div>
                            <div class="info">
                                <h3 ng-repeat="(local,title) in filterlocal(auction.title)"><% title %></h3>
                                <p ng-repeat="(local,description) in filterlocal(auction.description)"><% description %></p>
                                <a  ng-href="#/auction/<% auction._id %>" title="">{{trans('web_v1.goToAuction')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
















{{--<div class="container">--}}
{{--<div class="row" >--}}
    {{--<img src="asset/img/loading.gif" ng-show="loading" width="50" height="50">--}}
    {{--<div class="col-xs-6 col-lg-4" ng-repeat="auction in auctions">--}}

        {{--<h2 ng-repeat="(local,title) in filterlocal(auction.title)"><% title %></h2>--}}
        {{--<p ng-repeat="(local,description) in filterlocal(auction.description)"><% description %></p>--}}
        {{--<p ng-repeat="(local,title) in filterlocal(auction.title)">--}}
            {{--<img class="img-responsive" alt="<% title %>" src="/<% auction.media.image.mediaPath %>">--}}
        {{--</p>--}}
        {{--<p>--}}
            {{--<a class="btn btn-default"--}}
               {{--ng-href="#/auction/<% auction._id %>" role="button">شرکت در حراج »</a>--}}
        {{--</p></div>--}}
{{--</div>--}}
{{--</div>--}}
