<?php

namespace Modules\Comment\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Modules\Comment\App\Http\Requests\Front\CommentRequest;
use Modules\Comment\App\Models\Comment;
use Spatie\Honeypot\ProtectAgainstSpam;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store');
        $this->middleware(ProtectAgainstSpam::class)->only('store');
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        $model = $request->commentable_type::findOrFail($request->commentable_id);
        $comment = Comment::make([
            'comment' => $request->comment
        ]);
        if (!Auth::check()) {
            $comment->guest_name = $request->guest_name;
            $comment->guest_email = $request->guest_email;
        } else {
            $comment->commenter()->associate(Auth::user());
        }
        $comment->commentable()->associate($model);
        $comment->save();
        return redirect(URL::previous() . '#comments')->with(['success' => 'نظر شما با موفقیت ثبت شد. پس از تایید توسط پشتیبان، نمایش داده خواهد شد.']);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function reply(Request $request, $id): RedirectResponse
    {
        //
    }
}
