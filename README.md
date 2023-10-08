# Laravel Package For Wilayah Indonesia

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hanzoalpha/laravel-wilayah.svg?style=flat-square)](https://packagist.org/packages/hanzoalpha/laravel-wilayah)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hanzo-alpha/laravel-wilayah/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hanzo-alpha/laravel-wilayah/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hanzo-alpha/laravel-wilayah/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hanzo-alpha/laravel-wilayah/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hanzoalpha/laravel-wilayah.svg?style=flat-square)]
(https://packagist.org/packages/hanzoalpha/laravel-wilayah)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-wilayah.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-wilayah)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require hanzoalpha/laravel-wilayah
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-wilayah-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-wilayah-config"
```

This is the contents of the published config file:

```php
return [
    'table_prefix' => 'ind_',

    /**
     * API Configuration.
     */
    'api' => [
        /**
         * If enabled, this will load Indonesia API.
         * - http://localhost:8000/api/wilayah/provinces
         * - http://localhost:8000/api/wilayah/cities
         * - http://localhost:8000/api/wilayah/districts
         * - http://localhost:8000/api/wilayah/villages
         */
        'enabled' => true,

        /**
         * The middleware for Indonesia API.
         */
        'middleware' => ['api'],

        /**
         * The route name for Indonesia API.
         */
        'route_name' => 'api.wilayah',

        /**
         * The route prefix for Indonesia API.
         */
        'route_prefix' => 'api/wilayah',

        /**
         * Specify which column will be displayed in the response data.
         * Only support columns from database.
         */
        'response_columns' => [
            //.
            'province' => ['code', 'name'],

            'city' => ['city_code', 'province_code', 'name'],

            'district' => ['district_code', 'city_code', 'name'],

            'village' => ['village_code', 'district_code', 'name'],

            'island' => ['province_code', 'city_code', 'island_code', 'name'],
        ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-wilayah-views"
```

## Usage

```php
$laravelWilayah = new HanzoAlpha\LaravelWilayah();
echo $laravelWilayah->echoPhrase('Hello, HanzoAlpha!');
```

## Testing

```bash
  ./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Hanzo Alpha](https://github.com/hanzo-alpha)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
