<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Model: User
 */
class User extends Eloquent
{
    protected $table = 'users';

    protected $fillable = ['email', 'username', 'password', 'first_name', 'last_name'];

    protected $hidden = ['password'];
}
