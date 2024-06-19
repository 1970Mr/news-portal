<?php

namespace Modules\UserActivity\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\UserActivity\App\Models\RequestTrack;
use Modules\UserActivity\App\Services\RequestTrackService;

class RequestTrackController extends Controller
{
    public function __construct(private readonly RequestTrackService $requestTrackService)
    {
        $this->middleware('can:' . config('permissions_list.REQUEST_TRACK_INDEX', false))->only(['index', 'visitsStats']);
        $this->middleware('can:' . config('permissions_list.REQUEST_TRACK_DESTROY', false))->only('destroy');
    }

    public function index(Request $request)
    {
        $requestsTrack = $this->requestTrackService->index($request);
        return view('user-activity::requests-track.index', compact('requestsTrack'));
    }

    public function destroy(RequestTrack $requestTrack): RedirectResponse
    {
        $requestTrack->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('request_track')]));
    }

    public function visitsStats(): View
    {
        $visitCounts = RequestTrack::getVisitCounts();
        return view('user-activity::requests-track.visits-stats', compact('visitCounts'));
    }
}
