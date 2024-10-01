<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Management
 *
 * @method static Builder|Management newModelQuery()
 * @method static Builder|Management newQuery()
 * @method static Builder|Management query()
 * @mixin Eloquent
 */
final class Management extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'managements';

    public const ID = 'id';
    public const NAME = 'name';
    public const UNIT_ID = 'unit_id';
    public const FUNCTION = 'function';

    protected $fillable = [
        self::NAME,
        self::UNIT_ID,
        self::FUNCTION
    ];

}
