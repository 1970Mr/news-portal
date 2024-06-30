<div id="comments" class="comments-area block">
    <h3 class="block-title"><span>{{ $article->approvedComments->count() }} دیدگاه</span></h3>

    <ul class="comments-list">
        <li>
            @foreach($article->approvedComments as $comment)
                {{-- Display parent comments --}}
                @if(!$comment->parent_id)
                    <div class="comment">
                        <img class="comment-avatar pull-left" src="{{ $comment->commenterImageLink() }}" alt="{{ $comment->commenterName() }}">
                        <div class="comment-body">
                            <div class="meta-data">
                                <span class="comment-author">{{ ($comment->isGuest() ? 'کاربر مهمان: ' : '') . $comment->commenterName() }}</span>
                                <span class="comment-date pull-right">
                                    <i class="fa fa-clock-o"></i>
                                    <span>{{ jalalian()->forge($comment->created_at)->ago() }}</span>
                                </span>
                            </div>
                            <div class="comment-content">
                                <x-markdown>
                                    {{ $comment->comment }}
                                </x-markdown>
                            </div>
                            <div class="text-left">
                                <a class="comment-reply" data-toggle="modal" data-target="#commentReplyModal{{ $comment->id }}">پاسخ</a>
                                @canany('update', $comment)
                                    <a class="comment-edit" data-toggle="modal" data-target="#commentEditModal{{ $comment->id }}" style="margin-right: 1rem ">ویرایش</a>
                                @endcanany

                                @canany('delete', $comment)
                                    <form id="deleteForm{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a onclick="event.preventDefault(); document.querySelector('#deleteForm{{ $comment->id }}').submit()" class="comment-delete">حذف</a>
                                @endcanany
                            </div>

                            <div class="text-left">
                            </div>

                            <div class="modal fade" id="commentReplyModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
                                            <h4 class="modal-title" id="commentModalLabel" style="flex: 1;">پاسخ خود به دیدگاه موردنظر را بیان کنید</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="flex-shrink: 0;"><span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Your form here -->
                                            <form id="commentForm" role="form" action="{{ route('comments.reply', $comment->id) }}" method="POST">
                                                @include('front::single-article.partials.comment-form-inputs')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @canany('update', $comment)
                                <div class="modal fade" id="commentEditModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
                                                <h4 class="modal-title" id="commentModalLabel" style="flex: 1;">ویرایش دیدگاه</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="flex-shrink: 0;"><span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Your form here -->
                                                <form id="commentForm" role="form" action="{{ route('comments.update', $comment->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    @honeypot
                                                    <input type="hidden" name="commentable_type" value="{{ get_class($article) }}"/>
                                                    <input type="hidden" name="commentable_id" value="{{ $article->getKey() }}"/>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <textarea class="form-control required-field" name="comment" id="comment" placeholder="دیدگاه شما">{{ old('comment',
                                                            $comment->comment)
                                                            }}</textarea>
                                                            </div>
                                                        </div><!-- Col end -->
                                                    </div>

                                                    <div class="clearfix">
                                                        <button class="comments-btn btn btn-primary" type="submit">ارسال دیدگاه</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcanany
                        </div>
                    </div>

                    @include('front::single-article.partials.comments-reply')
                @endif
            @endforeach


        </li><!-- Comments-list li end -->
    </ul><!-- Comments-list ul end -->
</div><!-- Post comment end -->
