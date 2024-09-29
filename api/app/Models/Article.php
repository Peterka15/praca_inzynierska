<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $author
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article query()
 * @method static Builder|Article whereAuthorId($value)
 * @method static Builder|Article whereContent($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @mixin Eloquent
 */
final class Article extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'articles';

    public const AUTHOR_ID = 'author_id';
    public const TITLE = 'title';
    public const CONTENT = 'content';

    public const AUTHOR = 'author';
    public const IMAGES = 'images';
    public const COMMENTS = 'comments';
    public const TAGS = 'tags';

    protected $fillable = [
        self::AUTHOR_ID,
        self::TITLE,
        self::CONTENT,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];

    public function author(): HasOne
    {
        return $this->hasOne(User::class, User::ID, self::AUTHOR_ID);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, Image::ARTICLE_ID, self::ID);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, Comment::ARTICLE_ID, self::ID);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, ArticleTag::TABLE_NAME, ArticleTag::ARTICLE_ID, ArticleTag::TAG_ID);
    }
}
