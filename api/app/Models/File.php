<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $name
 * @property string $extension
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereExtension($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @method static Builder|File whereUserId($value)
 * @method static Builder|File whereUuid($value)
 * @mixin \Eloquent
 */
final class File extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'files';

    public const USER_ID = 'user_id';
    public const UUID = 'uuid';
    public const NAME = 'name';
    public const EXTENSION = 'extension';

    protected $fillable = [
        self::USER_ID,
        self::UUID,
        self::NAME,
        self::EXTENSION,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];
}
