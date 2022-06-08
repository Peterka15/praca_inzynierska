<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $article_id
 * @property string $author
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereArticleId($value)
 * @method static Builder|Comment whereAuthor($value)
 * @method static Builder|Comment whereContent($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Comment extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'comments';

    public const ARTICLE_ID = 'article_id';
    public const AUTHOR = 'author';
    public const CONTENT = 'content';

    protected $fillable = [
        self::ARTICLE_ID,
        self::AUTHOR,
        self::CONTENT,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];
}
