<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleAccess extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'resource',
        'allow'
    ];

    private static $_acl = null;

    public static function getRoleAccesses()
    {
        if (self::$_acl == null) {
            self::$_acl = [];
            $rows = UserRoleAccess::all();
            foreach ($rows as $row) {
                if (!isset(self::$_acl[$row->role])) {
                    self::$_acl[$row->role] = [];
                }
                self::$_acl[$row->role] = $row->allow;
            }
        }

        return self::$_acl;
    }
}
