<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\FileManager\App\Http\Requests\VideoRequest;
use Modules\FileManager\App\Models\Video;
use Modules\FileManager\App\Services\Video\VideoQueryService;
use Modules\FileManager\App\Services\Video\VideoService;

class VideoController extends Controller
{
    public function __construct(
        private readonly VideoService $videoService,
        private readonly VideoQueryService $videoQueryService
    ) {}

    public function index(Request $request): View
    {
        $videos = $this->videoQueryService->index($request);
        $videoClassName = Video::class;

        return view('file-manager::videos.index', compact('videos', 'videoClassName'));
    }

    public function create(): View
    {
        return view('file-manager::videos.create');
    }

    public function store(VideoRequest $request): RedirectResponse
    {
        $this->videoService->store($request);

        return to_route(config('app.panel_prefix', 'panel').'.videos.index')
            ->with('success', __('entity_created', ['entity' => __('video')]));
    }

    public function edit(Video $video)
    {
        return view('file-manager::videos.edit', compact('video'));
    }

    public function update(VideoRequest $request, Video $video): RedirectResponse
    {
        $this->videoService->update($request, $video);

        return to_route(config('app.panel_prefix', 'panel').'.videos.index')
            ->with('success', __('entity_edited', ['entity' => __('video')]));
    }

    public function destroy(Video $video): RedirectResponse
    {
        $this->videoService->destroy($video);

        return back()->with('success', __('entity_deleted', ['entity' => __('video')]));
    }

    public function deleteThumbnail(Video $video): RedirectResponse
    {
        if ($video->hasMedia('thumbnails')) {
            $video->clearMediaCollection('thumbnails');

            return back()->with('success', __('entity_deleted', ['entity' => __('thumbnail')]));
        }

        return back()->with('info', __('file-manager::messages.There is no personal thumbnail!'));
    }
}
