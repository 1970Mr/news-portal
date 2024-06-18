<?php

namespace Modules\UserActivity\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Modules\UserActivity\App\Models\UserTrack;

class UserTrackController extends Controller
{
    public function index(): View
    {
        $userTracks = UserTrack::with('user')->latest()->paginate(10);
        return view('user-activity::user-tracks.index', compact('userTracks'));
    }

    public function destroy(UserTrack $userTrack): RedirectResponse
    {
        $userTrack->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('user_track')]));
    }
}
