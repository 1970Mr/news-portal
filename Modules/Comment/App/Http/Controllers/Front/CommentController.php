<?php

namespace Modules\Comment\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Modules\Comment\App\Http\Requests\Front\CommentRequest;
use Modules\Comment\App\Services\CommentService;
use Spatie\Honeypot\ProtectAgainstSpam;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService)
    {
        $this->middleware('auth')->except('store');
        $this->middleware(ProtectAgainstSpam::class)->only('store');
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        $this->commentService->store($request);
        return redirect(URL::previous() . '#comments')->with(['success' => __('comment::messages.comment_saved_successfully')]);
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
