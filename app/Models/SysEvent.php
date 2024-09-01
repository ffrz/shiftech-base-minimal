<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SysEvent extends Model
{
    public $timestamps = false;

    public const AUTHENTICATION = 'Authentication';
    public const USER_MANAGEMENT = 'User Management';
    public const SETTINGS = 'Settings';

    protected $casts = [
        'data' => 'json'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'datetime',
        'type',
        'name',
        'description',
        'data',
    ];

    public static function log($type, $name, $description = '', $data = null, $username = null)
    {
        if ($username === null && Auth::user()) {
            $username = Auth::user()->username;
        }

        if ($username === null) {
            $username = '';
        }

        return self::create([
            'username' => $username,
            'datetime' => now(),
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'data' => $data,
        ]);
    }
}
