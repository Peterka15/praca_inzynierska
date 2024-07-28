<?php

declare(strict_types=1);

namespace App\Models\Enums;

use MyCLabs\Enum\Enum;

/**
 * Class UserRole
 *
 * Enum-like class for user roles.
 *
 * @method static UserRole ADMIN()      Represents the Admin role.
 * @method static UserRole MODERATOR()  Represents the Moderator role.
 * @method static UserRole USER()       Represents the User role.
 * @method static UserRole KOMENDANT()  Represents the Komendant role.
 * @method static UserRole PUBLIC()     Represents the Public role.
 */
class UserRole extends Enum {
    private const ADMIN = 'Admin';
    private const MODERATOR = 'Moderator';
    private const USER = 'User';
    private const KOMENDANT = 'Komendant';
    private const PUBLIC = 'Publiczne';
}
