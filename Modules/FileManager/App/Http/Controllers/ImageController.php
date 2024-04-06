<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;

class ImageController extends Controller
{
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
        $data = $request->validated();
        $file = $request->file('image');
        $file_name = $file->getClientOriginalName();
        $hash_name = pathinfo($file->hashName(), PATHINFO_FILENAME);;
        $file_name = "{$hash_name}_{$file_name}";
        $path = 'images/' . now()->format('Y/m/d');
        $data['file_path'] = Storage::disk('public')->putFileAs($path, $file, $file_name);
        Image::query()->create($data);
        return to_route('image.index')->with('success', 'تصویر با موفقیت ایجاد شد');
    }

    public function edit(Image $image): View
    {
        return view('file-manager::images.edit');
    }

    public function update(ImageRequest $request, image $image): RedirectResponse
    {
        return to_route('image.index')->with('success', 'تصویر با موفقیت به روز شد');
    }

    public function destroy(Image $image): RedirectResponse
    {
        $image->delete();
        return back()->with('success', 'تصویر با موفقیت حذف شد');
    }
}
