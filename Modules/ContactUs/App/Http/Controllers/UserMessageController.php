<?php

namespace Modules\ContactUs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Modules\ContactUs\App\Models\UserMessage;

class UserMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . config('permissions_list.CONTACT_USER_MESSAGES', false));
    }

    public function index(): View
    {
        $userMessages = UserMessage::query()->latest()->paginate(10);
        return view('contact-us::user-messages.index', compact(['userMessages']));
    }

    public function show(UserMessage $userMessage): View
    {
        return view('contact-us::user-messages.show', compact(['userMessage']));
    }
}
