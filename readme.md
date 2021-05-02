# Run artisan commands in parallel using ReactPHP.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stubleapp/laravel-parallel.svg?style=flat-square)](https://packagist.org/packages/stubleapp/laravel-parallel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/stubleapp/laravel-parallel/run-tests?label=tests)](https://github.com/stubleapp/laravel-parallel/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/stubleapp/laravel-parallel/Check%20&%20fix%20styling?label=code%20style)](https://github.com/stubleapp/laravel-parallel/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/stubleapp/laravel-parallel.svg?style=flat-square)](https://packagist.org/packages/stubleapp/laravel-parallel)

## Installation

You can install the package via composer:

```bash
composer require stubleapp/laravel-parallel
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Stubleapp\Parallel\LaravelParallelServiceProvider" --tag="laravel-parallel-config"
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
