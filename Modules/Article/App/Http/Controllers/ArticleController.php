<?php

namespace Modules\Article\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Article\App\Http\Requests\ArticleRequest;
use Modules\Article\App\Models\Article;
use Modules\Article\App\Services\ArticleService;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Services\ImageService;
use Modules\Tag\App\Models\Tag;

class ArticleController extends Controller
{
    public function __construct(public ArticleService $articleService) {}
    public function index(): View
    {
        $articles = Article::query()->latest()->paginate(10);
        return view('article::index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::query()->active()->latest()->get();
        $tags = Tag::query()->active()->latest()->get();
        return view('article::create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request, ImageService $imageService): RedirectResponse
    {
        $this->articleService->store($request, $imageService);
        return to_route('article.index')->with('success', __('entity_created', ['entity' => __('article')]));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('article::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('article::edit');
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
