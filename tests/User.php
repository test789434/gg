<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Auth\Authenticatable;
use GoldenGoose\Traits\HasSubscriptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
    use HasSubscriptions;
    use Authenticatable;

    protected $guarded = [];

    protected $table = 'users';

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
