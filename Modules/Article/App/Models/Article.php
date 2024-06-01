<?php

namespace Modules\Article\App\Models;

use Conner\Likeable\Likeable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Laravel\Scout\Searchable;
use Modules\Article\Database\Factories\ArticleFactory;
use Modules\Category\App\Models\Category;
use Modules\Comment\App\Traits\HasComments;
use Modules\FileManager\App\Traits\HasImage;
use Modules\Hotness\App\Traits\HasHotness;
use Modules\Tag\App\Models\Tag;
use Modules\User\App\Models\User;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Article extends Model implements Feedable
{
    use HasFactory, HasImage, HasHotness, HasComments, Searchable, Likeable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'keywords',
        'body',
        'published_at',
        'editor_choice',
        'status',
        'category_id',
        'user_id',
    ];

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link(route('news.show', [$this->category->slug, $this->slug]))
            ->authorName($this->user->full_name)
            ->authorEmail($this->user->email);
    }

    public static function getFeedItems(): Collection
    {
        return Article::latest()->limit(50)->get();
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => (int) $this->id,
            'slug' => $this->name,
            'description' => (float) $this->price,
            'keywords' => (float) $this->price,
        ];
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: static fn (string $value) => Str::slug($value),
        );
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', '<=', now());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tagNames(): string
    {
        return $this->tags->pluck('name')->implode(', ');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeHotness(Builder $query): void
    {
        $query->whereHas('hotness', function ($query) {
            $query->where('is_hot', true);
        });
    }

    public function scopeEditorChoice(Builder $query): void
    {
        $query->where('editor_choice', true);
    }

    public function bodyText(int $limit = 120): Stringable
    {
        $cleanedBody = str_replace('&nbsp;', ' ', $this->body);
        $strippedBody = strip_tags($cleanedBody);
        return str($strippedBody)->limit($limit);
    }

    public function previousArticle()
    {
        return $this->where('created_at', '<', $this->created_at)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function nextArticle()
    {
        return $this->where('created_at', '>', $this->created_at)
            ->orderBy('created_at')
            ->first();
    }

    public function relatedArticles($limit = 6)
    {
        $relatedArticles = $this->category->articles()
            ->with(['image', 'category', 'user'])
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit($limit)
            ->get();
        if ($relatedArticles->count() < 3) {
            $relatedArticles = self::with(['image', 'category', 'user'])
                ->where('id', '!=', $this->id)
                ->latest()
                ->limit($limit)
                ->get()
                ->shuffle();
        }
        return $relatedArticles;
    }

    protected static function newFactory(): ArticleFactory
    {
        return ArticleFactory::new();
    }
}
