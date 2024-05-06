<div id="comments" class="comments-area block">
    <h3 class="block-title"><span>{{ $article->approvedComments->count() }} دیدگاه</span></h3>

    <ul class="comments-list">
        <li>
            @foreach($article->approvedComments as $comment)
                <div class="comment">
                    <img class="comment-avatar pull-left" src="{{ $comment->commenterImageLink() }}" alt="{{ $comment->commenterName() }}">
                    <div class="comment-body">
                        <div class="meta-data">
                            <span class="comment-author">{{ ($comment->isGuest() ? 'کاربر مهمان: ' : '') . $comment->commenterName() }}</span>
                            <span class="comment-date pull-right">{{ jalalian()->forge($comment->created_at)->format(config('common.front_datetime_format')) }}</span>
                        </div>
                        <div class="comment-content">
                            <x-markdown>
                                {{ $comment->comment }}
                            </x-markdown>
                        </div>
                        <div class="text-left">
                            <a class="comment-reply" href="#">پاسخ</a>
                        </div>
                    </div>
                </div>
            @endforeach

{{--            <ul class="comments-reply">--}}
{{--                <li>--}}
{{--                    <div class="comment">--}}
{{--                        <img class="comment-avatar pull-left" alt="" src="{{ asset('home/images/news/user2.png') }}">--}}
{{--                        <div class="comment-body">--}}
{{--                            <div class="meta-data">--}}
{{--                                <span class="comment-author">فرهاد عظیم پور</span>--}}
{{--                                <span class="comment-date pull-right">26 دی 1396 - 15:36</span>--}}
{{--                            </div>--}}
{{--                            <div class="comment-content">--}}
{{--                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون</p></div>--}}
{{--                            <div class="text-left">--}}
{{--                                <a class="comment-reply" href="#">پاسخ</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!-- Comments end -->--}}
{{--                </li>--}}
{{--            </ul><!-- comments-reply end -->--}}
{{--            <div class="comment last">--}}
{{--                <img class="comment-avatar pull-left" alt="" src="{{ asset('home/images/news/user1.png') }}">--}}
{{--                <div class="comment-body">--}}
{{--                    <div class="meta-data">--}}
{{--                        <span class="comment-author">میلاد آقایی</span>--}}
{{--                        <span class="comment-date pull-right">26 دی 1396 - 15:36</span>--}}
{{--                    </div>--}}
{{--                    <div class="comment-content">--}}
{{--                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی</p></div>--}}
{{--                    <div class="text-left">--}}
{{--                        <a class="comment-reply" href="#">پاسخ</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- Comments end -->--}}
        </li><!-- Comments-list li end -->
    </ul><!-- Comments-list ul end -->
</div><!-- Post comment end -->
