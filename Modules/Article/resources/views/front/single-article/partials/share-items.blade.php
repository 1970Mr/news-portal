<div class="share-items clearfix">
    <ul class="post-social-icons unstyled">
        @foreach($shared_links as $social_name => $social_link)
            <li class="{{ $social_name }}">
                <a href="{{ $social_link }}">
                    <i class="fa fa-{{ $social_name }}"></i> <span class="ts-social-title">{{ $social_name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div><!-- Share items end -->
