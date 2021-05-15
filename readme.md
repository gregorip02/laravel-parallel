## Laravel parallel

Run parallel commands in your Laravel app using ReactPHP ChildProcess.

### Installation

You can install the package via composer:

```bash
composer require stubleapp/laravel-parallel
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Stubleapp\Parallel\LaravelParallelServiceProvider" --tag="parallel"
```

This is the contents of `config/parallel.php`:

```php
<?php

return [
    'tags' => [
        // Here you will put all your tasks
    ],
];
```

### Usage

```bash
# TODO: Add usage section in readme.md
```

### Testing

```bash
composer test
```

### Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

### Credits

- [Gregori Piñeres](https://github.com/gregorip02)
- [All Contributors](../../contributors)

### License

The MIT License (MIT). Please see [License File](license.md) for more information.
