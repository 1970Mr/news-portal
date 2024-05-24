@if($ads['first_sidebar'])
    <div class="{{ $sidebarClasses ?? 'col-lg-4 col-md-4 col-sm-12 col-xs-12' }}" style="{{ $sidebarStyles ?? '' }}">
        <div class="sidebar sidebar-right second-sidebar">
            <div class="widget widget-tags">
                <h3 class="block-title"><span>تبلیغات</span></h3>
                <div class="ads-list">
                    @foreach($ads['first_sidebar'] as $ad)
                        <div class="col-xs-5" style="padding: 0">
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
            </div><!-- Tags end -->
        </div><!--Sidebar right end -->
    </div><!-- Sidebar col end -->
@endif

