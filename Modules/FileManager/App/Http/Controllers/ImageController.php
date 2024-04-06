<?php

namespace Modules\FileManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\FileManager\App\Http\Requests\ImageRequest;
use Modules\FileManager\App\Models\Image;

class ImageController extends Controller
{
    public function index(): View
    {
        return view('image::index');
    }

    public function create(): View
    {
        return view('image::create');
    }

    public function store(ImageRequest $request): RedirectResponse
    {
        return to_route('image.index')->with('success', 'تصویر با موفقیت ایجاد شد');
    }

    public function edit(Image $image): View
    {
        return view('image::edit');
    }

    public function update(ImageRequest $request, image $image): RedirectResponse
    {
        return to_route('image.index')->with('success', 'تصویر با موفقیت به روز شد');
    }

    public function destroy(Image $image): RedirectResponse
    {
        return back()->with('success', 'تصویر با موفقیت حذف شد');
    }
}
