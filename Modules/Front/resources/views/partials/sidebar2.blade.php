<div class="{{ $sidebar_classes ?? 'col-xs-12' }}" style="{{ $sidebar_style ?? '' }}">
    <div class="sidebar sidebar-right second-sidebar">
        <div class="widget widget-tags">
            <h3 class="block-title"><span>آخرین برچسب‌ها</span></h3>
            <ul class="unstyled clearfix">
                @foreach($second_sidebar['latest_tags'] as $tag)
                    <li><a href="{{ route('tags.show', $tag->slug) }}">{{ $tag->name }}</a></li>
                @endforeach
            </ul>
        </div><!-- Tags end -->

        <div class="widget">
            <h3 class="block-title"><span>ما را دنبال کنید</span></h3>
            <ul class="social-icon" style="display: flex; flex-wrap: wrap; justify-content: center; gap: .3rem">
                @foreach($social_networks as $name => $url)
                    <li>
                        <a title="{{ ucfirst($name) }}" href="{{ $url }}" target="_blank">
                            <i class="fa fa-{{ $name }} with-color"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div><!-- Widget Social end -->

        <div class="widget m-bottom-0">
            <h3 class="block-title"><span>خبرنامه</span></h3>
            <div class="ts-newsletter">
                <div class="newsletter-introtext">
                    <h4>به روز باشید</h4>
                    <p>با عضویت در خبرنامه جدیدترین اخبار را در ایمیل خود دریافت کنید!</p>
                </div>

                <div class="newsletter-form">
                    <form action="{{ route('newsletters.subscribe') }}" method="post">
                        @csrf
                        @honeypot

                        <div class="form-group">
                            <input type="email" name="email" id="newsletter-form-email" class="form-control form-control-lg" placeholder="ایمیل" autocomplete="off">
                            <button class="btn btn-primary">عضویت</button>
                        </div>
                    </form>
                </div>
            </div><!-- Newsletter end -->
        </div><!-- Newsletter widget end -->
    </div><!--Sidebar right end -->
</div><!-- Sidebar col end -->
