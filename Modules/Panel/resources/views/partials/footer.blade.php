<div class="row footer-container">
    <div class="col-md-12">
        <div class="copyright">
            <p class="float-start">
                پنل ادمین سایت خبری {{ config('app.name') }}
            </p>
            <p class="float-end ltr tahoma">
                <span>©</span>
                {{--                <a href="{{ route(config('app.panel_prefix', 'panel') . '.index') }}" target="_blank">{{ config('app.name') }}</a>--}}
                <a href="{{ route('home.index') }}" target="_blank">{{ config('app.name') }}</a>
            </p>
        </div><!-- /.copyright -->
    </div><!-- /.col-md-12 -->
</div><!-- /.row -->
