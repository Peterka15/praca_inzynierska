<?php
declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property int $category_id
 * @property int $unit_id
 * @property int $available
 * @method static Builder|Inventory newModelQuery()
 * @method static Builder|Inventory newQuery()
 * @method static Builder|Inventory query()
 * @method static Builder|Inventory whereAmount($value)
 * @method static Builder|Inventory whereAvailable($value)
 * @method static Builder|Inventory whereCategoryId($value)
 * @method static Builder|Inventory whereId($value)
 * @method static Builder|Inventory whereName($value)
 * @method static Builder|Inventory whereUnitId($value)
 * @mixin Eloquent
 */
final class Inventory extends ApiModel
{
    use HasFactory;

    public const TABLE_NAME = 'inventories';

    public const ID = 'id';
    public const NAME = 'name';
    public const AMOUNT = 'amount';
    public const CATEGORY_ID = 'category_id';
    public const CATEGORY = 'category';
    public const UNIT_ID = 'unit_id';
    public const UNIT = 'unit';
    public const AVAILABLE = 'available';


    protected $fillable = [
        self::NAME,
        self::AMOUNT,
        self::CATEGORY_ID,
        self::UNIT_ID,
        self::AVAILABLE,
    ];

    public function unit(): HasOne
    {
        return $this->hasOne(Unit::class, Unit::ID, self::UNIT_ID);
    }

    public function category(): HasOne
    {
        return $this->hasOne(InventoryCategory::class, InventoryCategory::ID, self::CATEGORY_ID);
    }
}
