<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\ArticleTag
 *
 * @property int $id
 * @property int $tag_id
 * @property int $article_id
 * @method static Builder|ArticleTag newModelQuery()
 * @method static Builder|ArticleTag newQuery()
 * @method static Builder|ArticleTag query()
 * @method static Builder|ArticleTag whereArticleId($value)
 * @method static Builder|ArticleTag whereId($value)
 * @method static Builder|ArticleTag whereTagId($value)
 * @mixin \Eloquent
 */
final class ArticleTag extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'article_tags';

    public const ARTICLE_ID = 'article_id';
    public const TAG_ID = 'tag_id';

    public $timestamps = false;

    protected $fillable = [
        self::ARTICLE_ID,
        self::TAG_ID
    ];
}
