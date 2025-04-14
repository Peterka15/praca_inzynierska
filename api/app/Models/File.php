<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $name
 * @property string $mime_type
 * @property string $extension
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereMimeType($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @method static Builder|File whereUserId($value)
 * @method static Builder|File whereUuid($value)
 * @mixin Eloquent
 */
final class File extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'files';

    public const USER_ID = 'user_id';
    public const USER = 'user';
    public const UUID = 'uuid';
    public const URL = 'url';
    public const NAME = 'name';
    public const MIME_TYPE = 'mime_type';
    public const EXTENSION = 'extension';

    protected $fillable = [
        self::USER_ID,
        self::UUID,
        self::NAME,
        self::MIME_TYPE,
        self::EXTENSION,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];

    public function path(): string
    {
        return env('APP_URL') . "/api/files/$this->uuid";
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, User::ID, self::USER_ID);
    }
}
