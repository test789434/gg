### Installation
`composer req test789434/gg`

#### Laravel without auto-discovery:
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php
```
GoldenGoose\SubscriptionServiceProvider::class
```

Add next lines to your User model:

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use GoldenGoose\Traits\HasSubscriptions; <-- this line

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasSubscriptions; <-- this line
```

Publish migrations and run it:

```
php artisan vendor:publish --provider="GoldenGoose\SubscriptionServiceProvider" --tag="migrations"
php artisan migrate
```

### Usage

User subscriptions available by route `GET /subscriptions`

If you have fresh installed Laravel application with not implemented authentication use breeze package to fast access to subscriptions
```
composer req laravel/breeze
php artisan breeze:install
npm install && npm run dev
```

To create fake subscriptions:
```
php artisan tinker
>>> \GoldenGoose\Models\Subscription::factory()->count(10)->create()
```

#### User model
You can access to user subscriptions via `subscriptions` property
```
$user->subscriptions;
```
To bidirectional association with user by default uses `App\Models\User::class`.
To use another model publish config and change it
```
php artisan vendor:publish --provider="GoldenGoose\SubscriptionServiceProvider" --tag="config"
```
```º
[
    'user' => App\Models\User::class
]
```

#### Events
Package provides event `SubscriptionsWasUpdated`. It fires whe user update subscriptions. 

