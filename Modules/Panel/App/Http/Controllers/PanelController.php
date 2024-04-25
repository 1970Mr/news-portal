<?php

namespace Modules\Panel\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Models\Image;
use Modules\Panel\App\Services\PanelService;
use Modules\Tag\App\Models\Tag;

class PanelController extends Controller
{
    public function __construct(private readonly PanelService $panelService) {}

    public function __invoke(): View
    {
        $dataCounts = $this->panelService->getDataCounts();
        $articles = $this->panelService->getLimitedData(Article::class);
        $categories = $this->panelService->getLimitedData(Category::class);
        $tags = $this->panelService->getLimitedData(Tag::class);
        $images = $this->panelService->getLimitedData(Image::class);
        $imageClassName = Image::class;

        return view('panel::index', compact('dataCounts', 'articles', 'categories', 'tags', 'images', 'imageClassName'));
    }
}
