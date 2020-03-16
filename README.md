
# Laravel Idempotency
A super simple, customisable and automatically registering middleware to help you ensure your requests are Idempotent when it’s required.

Inspired by the guys at Stripe https://stripe.com/blog/idempotency and the realisation of how important this little feature is I mocked up this package. 

Features
--

The idempotency layer compares incoming parameters to those of the original request and errors unless they're the same to prevent accidental misuse.

Once installed you can do stuff like this:

```php
// Adding idempotency layer to a route
Route::post('hello-world', function() {
    // stuff
})->middleware('idempotent');
```

## Installation

You can install the package via composer:
```
composer require danielebuso/idempotency
```

## Customization

You can publish the package config by running:
```
php artisan vendor:publish --provider="idempotency\ServiceProvider"
```

| Key             | Default         | Description                                                                            |
|-----------------|-----------------|----------------------------------------------------------------------------------------|
| IDEMPOTENCY_KEY | Idempotency-Key | The key name specified in request headers to look for                                  |
| IDEMPOTENCY_TTL | 3600            | Specify the time (in minutes) that the request will be cached for. Defaults to 1 hour. |

You can also customize idempotency methods to other than `POST`, however it should be noted that:
> According to HTTP semantics, the PUT and DELETE verbs are idempotent, and the PUT verb in particular signifies that a target resource should be created or replaced entirely with the contents of a request’s payload.