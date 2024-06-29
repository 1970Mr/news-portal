<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\FileManager\App\Models\Video;
use Modules\FileManager\App\Services\Video\VideoService;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::query()->latest()->paginate(10);
        return view('file-manager::videos.index', compact('videos'));
    }

    public function create(): View
    {
        return view('file-manager::videos.create');
    }

    public function store(Request $request, VideoService $videoService): RedirectResponse
    {
        $videoService->storeVideo($request);
        return redirect()->route(config('app.panel_prefix', 'panel') . '.videos.index')->with('success', 'ویدئو با موفقیت ایجاد شد.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('filemanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('filemanager::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
