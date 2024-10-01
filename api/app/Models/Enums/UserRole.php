<?php

declare(strict_types=1);

namespace App\Models\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static UserRole ADMIN()
 * @method static UserRole MODERATOR()
 * @method static UserRole USER()
 * @method static UserRole COMMANDANT()
 * @method static UserRole PUBLIC()
 * @method static UserRole DISABLED()
 */
class UserRole extends Enum
{
    private const ADMIN = 1;
    private const MODERATOR = 2;
    private const USER = 3;
    private const COMMANDANT = 4;
    private const PUBLIC = 5;
    private const DISABLED = 6;
}
