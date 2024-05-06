{{-- All replies--}}
@foreach(get_class($comment)::getAllDescendants($comment) as $child_comment)
    <ul class="comments-reply">
        <li>
            <div class="comment">
                <img class="comment-avatar pull-left" src="{{ $child_comment->commenterImageLink() }}" alt="{{ $child_comment->commenterName() }}">
                <div class="comment-body">
                    <div class="meta-data">
                        <span class="comment-author">{{ ($child_comment->isGuest() ? 'کاربر مهمان: ' : '') . $child_comment->commenterName() }}</span>
                        <span class="comment-date pull-right">{{ jalalian()->forge($child_comment->created_at)->format(config('common.front_datetime_format')) }}</span>
                    </div>
                    <div class="comment-content">
                        <x-markdown>
                            {{ $child_comment->comment }}
                        </x-markdown>
                    </div>
                    <div class="text-left">
                        <a class="comment-reply" href="#" data-toggle="modal" data-target="#commentModal{{ $child_comment->id }}">پاسخ</a>
                    </div>

                    <div class="modal fade" id="commentModal{{ $child_comment->id }}" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
                                    <h4 class="modal-title" id="commentModalLabel" style="flex: 1;">پاسخ خود به دیدگاه موردنظر را بیان کنید</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="flex-shrink: 0;"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Your form here -->
                                    <form id="commentForm" role="form" action="{{ route('comments.reply', $child_comment->id) }}" method="POST">
                                        @include('front::single-post.partials.comment-form-inputs')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </li>
    </ul><!-- comments-reply end -->
@endforeach
