@if(count($ads['first_section']) > 0)
    <section class="block-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="latest-news block color-red">
                        <h3 class="block-title"><span>تبلیغات</span></h3>

                        <div class="ads-list">
                            @foreach($ads['first_section'] as $ad)
                                <div class="col-xl-6 col-md-3" style="padding: 0;">
                                    <div class="post-block-style clearfix">
                                        <div class="post-thumb">
                                            <a href="{{ $ad->link }}">
                                                <img class="img-responsive" src="{{ asset('storage/' . $ad->image->file_path) }}" alt="{{ $ad->image->alt_text }}" style="max-height: 20rem;">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <h2 class="post-title title-medium">
                                                <a href="{{ $ad->link }}">{{ $ad->title }}</a>
                                            </h2>
                                        </div>
                                    </div><!-- Post Block style end -->
                                </div>
                            @endforeach
                        </div>
                    </div><!--- Latest news end -->
                </div><!-- Content Col end -->
            </div>
        </div>
    </section>
@endif
