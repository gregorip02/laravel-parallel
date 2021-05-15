# Laravel parallel

Run parallel commands in your Laravel app using ReactPHP ChildProcess.

## Installation

You can install the package via composer:

```bash
composer require stubleapp/laravel-parallel
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Stubleapp\Parallel\LaravelParallelServiceProvider" --tag="parallel"
```

This is the contents of the published config file:

```php

return [
];
```

## Usage

```bash
# TODO: Add usage section in readme.md
```

## Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Gregori Piñeres](https://github.com/gregorip02)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
