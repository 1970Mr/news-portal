<div id="top-bar" class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="ts-date">
                    <i class="fa fa-calendar-check-o"></i>
                    {{ jalalian()->now()->format(config('common.front_date_format')) }}
                </div>
                <ul class="unstyled top-nav">
                    <li><a href="{{ route('about-us.index') }}">درباره ما</a></li>
                    <li><a href="{{ route('contact-us.index') }}">تماس با ما</a></li>
                </ul>
                </ul>
            </div><!--/ Top bar left end -->

            <div class="col-md-4 col-sm-4 col-xs-12 top-social text-right">
                <ul class="unstyled">
                    <li>
                        @foreach($social_networks as $name => $url)
                            <a title="{{ ucfirst($name) }}" href="{{ $url }}" target="_blank">
                                <span class="social-icon"><i class="fa fa-{{ $name }}"></i></span>
                            </a>
                        @endforeach
                    </li>
                </ul><!-- Ul end -->
            </div><!--/ Top social col end -->
        </div><!--/ Content row end -->
    </div><!--/ Container end -->
</div><!--/ Topbar end -->
