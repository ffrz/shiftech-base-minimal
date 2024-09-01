<?php

namespace App\Models;

class UserRole
{
    const SUPER_ADMINISTRATOR = 1;
    const ADMINISTRATOR = 2;
    const OPERATOR = 3;

    private static $_roles = [
        self::SUPER_ADMINISTRATOR => 'Super Administrator',
        self::ADMINISTRATOR => 'Administrator',
        self::OPERATOR => 'Operator',
    ];

    public static function getRoles() {
        return self::$_roles;
    }
}
