<?php

namespace Modules\SEOManager\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Tag\App\Models\Tag;
use Modules\User\App\Models\User;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     */
    protected $description = 'Generate the sitemap for the website';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemapPath = public_path('sitemaps');
        if (!File::exists($sitemapPath)) {
            File::makeDirectory($sitemapPath, 0755, true);
        }

        $this->generateHomePageSitemap();
        $this->generateArticlesSitemap();
        $this->generateCategoriesSitemap();
        $this->generateTagsSitemap();
        $this->generateAuthorsSitemap();

        $this->generateSitemapIndex();

        $this->info('Sitemaps have been generated successfully.');
    }

    protected function generateHomePageSitemap(): void
    {
        $sitemap = Sitemap::create();

        $sitemap->add(Url::create(route('home.index'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0));

        $sitemap->writeToFile(public_path('sitemaps/homepage.xml'));
    }

    protected function generateArticlesSitemap(): void
    {
        $sitemap = Sitemap::create();

        $articles = Article::all();
        foreach ($articles as $article) {
            $sitemap->add(Url::create($article->getUrl())
                ->setLastModificationDate($article->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        }

        $sitemap->writeToFile(public_path('sitemaps/news.xml'));
    }

    protected function generateCategoriesSitemap(): void
    {
        $sitemap = Sitemap::create();

        $categories = Category::all();
        foreach ($categories as $category) {
            $sitemap->add(Url::create(route('categories.show', $category->slug))
                ->setLastModificationDate($category->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.6));
        }

        $sitemap->writeToFile(public_path('sitemaps/categories.xml'));
    }

    protected function generateTagsSitemap(): void
    {
        $sitemap = Sitemap::create();

        $tags = Tag::all();
        foreach ($tags as $tag) {
            $sitemap->add(Url::create(route('tags.show', $tag->slug))
                ->setLastModificationDate($tag->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.5));
        }

        $sitemap->writeToFile(public_path('sitemaps/tags.xml'));
    }

    protected function generateAuthorsSitemap(): void
    {
        $sitemap = Sitemap::create();

        $authors = User::with('articles')->whereHas('articles')->get();
        foreach ($authors as $author) {
            $sitemap->add(Url::create(route('author.index', $author->username))
                ->setLastModificationDate($author->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.5));
        }

        $sitemap->writeToFile(public_path('sitemaps/authors.xml'));
    }

    protected function generateSitemapIndex(): void
    {
        $sitemapIndex = SitemapIndex::create()
            ->add('/sitemaps/homepage.xml')
            ->add('/sitemaps/news.xml')
            ->add('/sitemaps/categories.xml')
            ->add('/sitemaps/tags.xml')
            ->add('/sitemaps/authors.xml');

        $sitemapIndex->writeToFile(public_path('sitemap_index.xml'));
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
