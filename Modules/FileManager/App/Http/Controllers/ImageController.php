<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\FileManager\App\Exceptions\ImageDeleteException;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\Image\ImageService;

class ImageController extends Controller
{
    public function __construct(
        private readonly ImageService $imageService,
    )
    {
    }

    public function index(Request $request): View
    {
        $filters = Image::filters();
        $imageClassName = Image::Class; // Use for policy
        $images = $this->imageService->index($request);
        return view('file-manager::images.index', compact('images', 'filters', 'imageClassName'));
    }

    public function create(): View
    {
        return view('file-manager::images.create');
    }

    public function edit(Image $image): View
    {
        return view('file-manager::images.edit', compact('image'));
    }

    public function update(ImageRequest $request, image $image): RedirectResponse
    {
        $this->imageService->update($request, $image);
        return to_route(config('app.panel_prefix', 'panel') . '.images.index')->with('success', __('entity_edited', ['entity' => __('image')]));
    }

    public function destroy(Image $image): RedirectResponse
    {
        try {
            $this->imageService->destroy($image);
            return back()->with('success', __('entity_deleted', ['entity' => __('image')]));
        } catch (ImageDeleteException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function imageSelectorData(Request $request): JsonResponse
    {
        $images = $this->imageService->imageSelectorData($request);
        return response()->json(compact('images'), 200);
    }

    public function imageSelectorFilters(): JsonResponse
    {
        $filters = $this->imageService->canAccessAllImages() ?
            Image::filters() :
            null;
        return response()->json(compact('filters'), 200);
    }

    public function imageUpload(ImageRequest $request): JsonResponse
    {
        $image = $this->imageService->store($request, altText: 'News Image');
        $response = [
            'message' => __('entity_created', ['entity' => __('image')]),
            'url' => $image->url(),
        ];
        return response()->json($response, 200);
    }

    public function store(ImageRequest $request): RedirectResponse
    {
        $this->imageService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.images.index')->with('success', __('entity_created', ['entity' => __('image')]));
    }
}
