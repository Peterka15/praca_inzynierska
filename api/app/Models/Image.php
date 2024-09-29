<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property string $uuid
 * @property string $mime_type
 * @property int $article_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereArticleId($value)
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereMimeType($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @method static Builder|Image whereUuid($value)
 * @mixin Eloquent
 */
final class Image extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'images';

    public const ARTICLE_ID = 'article_id';
    public const UUID = 'uuid';
    public const MIME_TYPE = 'mime_type';

    protected $fillable = [
        self::ARTICLE_ID,
        self::UUID,
        self::MIME_TYPE,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];

    public function path(): string
    {
        return env('APP_URL') . "/api/images/$this->uuid";
    }
}
