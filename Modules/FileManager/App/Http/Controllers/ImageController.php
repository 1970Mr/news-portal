<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\ImageService;
use Modules\User\App\Models\User;

class ImageController extends Controller
{
    public function __construct(
        public ImageService $imageService,
    ) {}

    public function index(Request $request): View
    {
        $filters = Image::filters();
        $images = $this->imageService->index($request);
        return view('file-manager::images.index', compact('images', 'filters'));
    }

    public function create(): View
    {
        return view('file-manager::images.create');
    }

    public function store(ImageRequest $request): RedirectResponse
    {
        $this->imageService->store($request);
        return to_route('image.index')->with('success', __('entity_created', ['entity' => __('image')]));
    }

    public function edit(Image $image): View
    {
        return view('file-manager::images.edit', compact('image'));
    }

    public function update(ImageRequest $request, image $image): RedirectResponse
    {
        $this->imageService->update($request, $image);
        return to_route('image.index')->with('success', __('entity_edited', ['entity' => __('image')]));
    }

    public function destroy(Image $image): RedirectResponse
    {
        $this->imageService->destroy($image);
        return back()->with('success', __('entity_deleted', ['entity' => __('image')]));
    }
}
