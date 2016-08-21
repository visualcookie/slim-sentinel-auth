<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;

class User extends SentinelUser
{
  protected $table = 'users';
  
  protected $fillable = [
    'username',
    'displayname',
    'email',
    'password',
    'permissions'
  ];

  protected $loginNames = ['email', 'username'];
}
