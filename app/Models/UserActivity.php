<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserActivity extends Model
{
    public $timestamps = false;

    public const AUTHENTICATION = 'authentication';
    public const USER_MANAGEMENT = 'user-mgmt';
    public const SETTINGS = 'settings';

    private static $_types = [
        self::AUTHENTICATION => 'Otentikasi',
        self::SETTINGS => 'Pengaturan',
        self::USER_MANAGEMENT => 'Pengelolaan Pengguna',
    ];

    protected $casts = [
        'data' => 'json'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'username',
        'datetime',
        'type',
        'name',
        'description',
        'data',
    ];

    public static function log($type, $name, $description = '', $data = null, $username = null, $user_id = null)
    {
        $user = Auth::user();
        $id = $user_id;
        if ($username === null && $user) {
            $username = $user->username;
            $id = $user->id;
        }

        if ($username === null) {
            $username = '';
        }

        return self::create([
            'user_id' => $id,
            'username' => $username,
            'datetime' => now(),
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'data' => $data,
        ]);
    }

    function typeFormatted()
    {
        return self::$_types[$this->type];
    }

    static function types() {
        return static::$_types;
    }
}
