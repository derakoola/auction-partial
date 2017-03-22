<section class="cover-page">
    <h4>{{trans('web_v1.aboutUs')}}</h4>
</section>
<div class="breadcrumb">
    <div class="container">
        <ol>
            <li><a href="" title="">{{trans('web_v1.home')}}</a></li>
            <li class="active">{{trans('web_v1.aboutUs')}}</li>
        </ol>
    </div>
</div>
<section class="default">
    <nav>
        <div class="container">
            <ul>
                <li class="active"><a href="" title="">{{trans('web_v1.aboutUs')}}</a></li>
                <li><a href="" title="">{{trans('web_v1.contactUs')}}</a></li>
                <li><a href="" title="">{{trans('about.privacy')}}</a></li>
                <li><a href="" title="">{{trans('about.copyright')}}</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2">
                <div class="info">
                    <div class="enlarge">
                        <span>{{trans('about.enlargeText')}}</span>
                        <a class="large" href="" title=""></a>
                        <a class="small" href="" title=""></a>
                    </div>
                    <a class="download button button--aylen" href="" title="">{{trans('about.download')}}</a>
                </div>
            </div>
            <div class="cok-xs-12 col-sm-10">
                <p>{{trans('about.aboutText')}}</p>
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

</main>