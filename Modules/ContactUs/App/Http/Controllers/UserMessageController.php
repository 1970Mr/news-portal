<?php

namespace Modules\ContactUs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\ContactUs\App\Models\UserMessage;
use Modules\ContactUs\App\Services\UserMessageService;

class UserMessageController extends Controller
{
    public function __construct(private readonly UserMessageService $userMessageService)
    {
        $this->middleware('can:' . config('permissions_list.CONTACT_USER_MESSAGES', false));
    }

    public function index(Request $request): View
    {
        $userMessages = $this->userMessageService->getUserMessages($request);
        $filters = UserMessage::USER_MESSAGE_STATUS;
        $filters[] = 'all';
        return view('contact-us::user-messages.index', compact(['userMessages', 'filters']));
    }

    public function show(UserMessage $userMessage): View
    {
        $userMessage->markAsSeen();
        return view('contact-us::user-messages.show', compact(['userMessage']));
    }
}
