<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\ImageService;

class ImageController extends Controller
{
    public function __construct(
        public ImageService $imageService
    ) {}

    public function index(Request $request): View
    {
        $filters = Image::filters();
        $query = Image::query()->latest();

        if ($request->has('filter')) {
            $filter = $request->filter;
            if ($filter === 'my_images') {
                $query->where('user_id', auth()->id());
            } elseif ($filter === 'other_users_images') {
                $query->where('user_id', '!=', auth()->id());
            }
        }

        $images = $query->paginate(10);
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
        $image->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('image')]));
    }
}
