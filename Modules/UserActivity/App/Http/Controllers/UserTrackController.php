<?php

namespace Modules\UserActivity\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\UserActivity\App\Models\UserTrack;
use Modules\UserActivity\App\Services\UserTrackService;

class UserTrackController extends Controller
{
    public function __construct(private readonly UserTrackService $userTrackService)
    {
        $this->middleware('can:' . config('permissions_list.USER_TRACK_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.USER_TRACK_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $usersTrack = $this->userTrackService->index($request);
        return view('user-activity::users-track.index', compact('usersTrack'));
    }

    public function destroy(UserTrack $userTrack): RedirectResponse
    {
        $userTrack->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('user_track')]));
    }
}
