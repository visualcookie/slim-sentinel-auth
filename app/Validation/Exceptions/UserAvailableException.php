<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class UserAvailableException extends ValidationException
{
  public static $defaultTemplates = [
    self::MODE_DEFAULT => [
      self::STANDARD => 'Username already in use',
    ],
  ];
}
