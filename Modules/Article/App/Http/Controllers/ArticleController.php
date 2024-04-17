<?php

namespace Modules\Article\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Article\App\Http\Requests\ArticleRequest;
use Modules\Article\App\Models\Article;
use Modules\Article\App\Services\ArticleService;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Services\ImageService;
use Modules\Tag\App\Models\Tag;

class ArticleController extends Controller
{
    public function __construct(
        public ArticleService $articleService,
        public ImageService $imageService
    ) {}
    public function index(): View
    {
        $articles = Article::query()->latest()->paginate(10);
        return view('article::index', compact('articles'));
    }

    public function create(): View
    {
        $categories = Category::query()->active()->latest()->get();
        $tags = Tag::query()->active()->latest()->get();
        return view('article::create', compact('categories', 'tags'));
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->articleService->store($request, $this->imageService);
        return to_route('article.index')->with('success', __('entity_created', ['entity' => __('article')]));
    }

    public function edit(Article $article): View
    {
        $categories = Category::query()->active()->latest()->get();
        $tags = Tag::query()->active()->latest()->get();
        return view('article::edit', compact('categories', 'tags', 'article'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        if ($request->hasFile('featured_image')) {
            $data['featured_image_id'] = $this->imageService->store($request, 'featured_image')->id;
            $this->imageService->destroyWithoutKeyConstraints($article->featured_image);
        }
        $article->update($data);
        $article->tags()->sync($request->get('tag_ids', []));
        return to_route('article.index')->with('success', __('entity_edited', ['entity' => __('article')]));
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->destroy($article, $this->imageService);
        return to_route('article.index')->with('success', __('entity_deleted', ['entity' => __('article')]));
    }
}
