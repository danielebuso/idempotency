
# Laravel Idempotency
A super simple, customisable and automatically registering middleware to help you ensure your requests are Idempotent when it’s required.

Inspired by the guys at Stripe https://stripe.com/blog/idempotency and the realisation of how important this little feature is I mocked up this package. 

Install with
```
composer require danielebuso/idempotency
```

The use it as it follow
```
Route::post('hello-world', function() {
    // stuff
})->middleware('idempotent');
```


To publish the configuration run
```
php artisan vendor:publish --provider="idempotency\ServiceProvider"
```
