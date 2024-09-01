<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'username',
        'password',
        'active',
        'fullname',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Checks whether the specified resource can be accessed by the corresponding user.
     * @var string $resource Resouce id
     * @return boolean Return true if the resource can be accesed otherwise false.
     */
    public function canAccess($resource)
    {
        // super admin bisa mengkases semua resource
        if ($this->role == UserRole::SUPER_ADMINISTRATOR) {
            return true;
        }

        $acl = UserRoleAccess::getRoleAccesses();

        return isset($acl[$this->role][$resource]) && $acl[$this->role][$resource];
    }
}
