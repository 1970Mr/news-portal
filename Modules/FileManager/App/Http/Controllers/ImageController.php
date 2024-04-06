<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;
use Modules\FileManager\App\Services\ImageService;

class ImageController extends Controller
{
    public function __construct(
        public ImageService $imageService
    ) {}

    public function index(): View
    {
        $images = Image::query()->latest()->paginate(10);
        return view('file-manager::images.index', compact('images'));
    }

    public function create(): View
    {
        return view('file-manager::images.create');
    }

    public function store(ImageRequest $request): RedirectResponse
    {
        $this->imageService->store($request);
        return to_route('image.index')->with('success', 'تصویر با موفقیت ایجاد شد');
    }

    public function edit(Image $image): View
    {
        return view('file-manager::images.edit', compact('image'));
    }

    public function update(ImageRequest $request, image $image): RedirectResponse
    {
        $this->imageService->update($request, $image);
        return to_route('image.index')->with('success', 'تصویر با موفقیت به روز شد');
    }

    public function destroy(Image $image): RedirectResponse
    {
        $image->delete();
        return back()->with('success', 'تصویر با موفقیت حذف شد');
    }
}
