<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property-read Collection|Article[] $articles
 * @property-read int|null $articles_count
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
 * @mixin Eloquent
 */
final class Tag extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'tags';

    public const NAME = 'name';

    public const ARTICLES = 'articles';

    public $timestamps = false;

    protected $fillable = [
        self::NAME
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, ArticleTag::TABLE_NAME, ArticleTag::TAG_ID, ArticleTag::ARTICLE_ID);
    }
}
