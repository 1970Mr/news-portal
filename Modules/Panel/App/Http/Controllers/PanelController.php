<?php

namespace Modules\Panel\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Models\Image;
use Modules\Tag\App\Models\Tag;
use Modules\User\App\Models\User;

class PanelController extends Controller
{
    public function __invoke(): View
    {
        $users_count = User::query()->count();
        $articles_count = Article::query()->count();
        $categories_count = Category::query()->count();

        $articles = Article::query()->latest()->limit(5)->get();
        $categories = Category::query()->latest()->limit(5)->get();
        $tags = Tag::query()->latest()->limit(5)->get();
        $images = Image::query()->latest()->limit(5)->get();
        $imageClassName = Image::class;
        return view('panel::index', compact([
            'users_count',
            'articles_count',
            'categories_count',
            'articles',
            'categories',
            'tags',
            'images',
            'imageClassName',
        ]));
    }
}
