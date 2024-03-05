# Lighthouse Scalars

[![Latest Version on Packagist](https://img.shields.io/packagist/v/odder/lighthouse-scalars.svg?style=flat-square)](https://packagist.org/packages/odder/lighthouse-scalars)
[![Tests Coverage](https://img.shields.io/codecov/c/github/odder/lighthouse-scalars?style=flat-square)](https://codecov.io/gh/odder/lighthouse-scalars)
[![PHP version](https://img.shields.io/packagist/php-v/odder/lighthouse-scalars?style=flat-square)]()
[![webonyx/graphql-php](https://img.shields.io/badge/graphql--php-^15.0.0-blue?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/odder/lighthouse-scalars.svg?style=flat-square)](https://packagist.org/packages/odder/lighthouse-scalars)
[![License](https://img.shields.io/packagist/l/odder/lighthouse-scalars?style=flat-square)](https://packagist.org/packages/odder/lighthouse-scalars)

This package provides a set of custom scalars for the [webonyx/graphql-php](https://github.com/webonyx/graphql-php) library, which is used under the hood by [Lighthouse](https://lighthouse-php.com/), a PHP port of the popular [GraphQL](https://graphql.org/) server.


## Supported Scalars

The following scalars are supported:

😍😍😍:
- `Emoji` - see [Emoji](https://en.wikipedia.org/wiki/Emoji)

Numbers:
- `PositiveFloat` - see [Positive number](https://en.wikipedia.org/wiki/Natural_number)
- `NegativeFloat` - see [Negative number](https://en.wikipedia.org/wiki/Negative_number)
- `PositiveInt` - see [Positive integer](https://en.wikipedia.org/wiki/Natural_number)
- `NegativeInt`

Localization:
- `CurrencyCode` - see [ISO 4217 alpha-3](https://en.wikipedia.org/wiki/ISO_4217)
- `CountryCode` - see [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)
- `Email` - see [RFC 5322](https://tools.ietf.org/html/rfc5322)
- `LanguageCode` - see [ISO 639-1](https://en.wikipedia.org/wiki/ISO_639-1)
- `Locale` - Simple locale string. see [Locale](https://en.wikipedia.org/wiki/Locale_(computer_software)) (`en`, `en-US`, `en-GB`, `fr`, `fr-FR`, `fr-CA`, etc.)

Geography:
- `Latitude` - Extends GeoCoordinate. see [Latitude](https://en.wikipedia.org/wiki/Latitude)
- `Longitude` - Extends GeoCoordinate. see [Longitude](https://en.wikipedia.org/wiki/Longitude)
- `GeoCoordinate` - see [Geographic coordinate system](https://en.wikipedia.org/wiki/Geographic_coordinate_system)
- `CountryCode` - see [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2)

Internet:
- `URL` - see [URL](https://en.wikipedia.org/wiki/URL)
- `URI` - see [URI](https://en.wikipedia.org/wiki/Uniform_Resource_Identifier)
- `IPv4` - see [IPv4](https://en.wikipedia.org/wiki/IPv4)
- `IPv6` - see [IPv6](https://en.wikipedia.org/wiki/IPv6)
- `SemVer` - see [Semantic Versioning](https://semver.org/)
- `UUID` - Using UUID4. see [UUID](https://en.wikipedia.org/wiki/Universally_unique_identifier)

Markup:
- `JSON` - see [JSON](https://en.wikipedia.org/wiki/JSON)
- `HTML` - Sanitised using [HTML Purifier](http://htmlpurifier.org/) to prevent XSS attacks. see [HTML](https://en.wikipedia.org/wiki/HTML)
- `Markdown` - see [Markdown](https://en.wikipedia.org/wiki/Markdown)

## Installation

You can install the package via composer:

```bash
composer require odder/lighthouse-scalars
```

## Usage

### Using Lighthouse

You can opt-in to the scalars you want by registering them in the `TypeRegistry` in a service provider. For example, you can register the `PositiveFloat` and `Emoji` scalars in the `AppServiceProvider`:

```php
use Odder\LighthouseScalars\Scalars;
use Nuwave\Lighthouse\Schema\TypeRegistry;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ...
    }

    public function register(TypeRegistry $typeRegistry)
    {
        $typeRegistry->register(Scalars::PositiveFloat);
        $typeRegistry->register(Scalars::Emoji);
    }
}
```

After you have registered the Scalars you need in the `TypeRegistry`, you can use them in your schema:

```graphql
type Query {
  mood: Emoji!
  naturalNumber: PositiveFloat!
}
```

### Testing

This package includes a set of tests for each scalar. To run the tests, use the following command:

```bash
composer test
```

## Documentation

For more information on how to use each scalar, please refer to the [documentation](https://lighthouse-scalars.odder.dev/docs).

## Contributing

Contributions are welcome! Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Odder](https://www.github.com/odder)
- [All Contributors](../../contributors)
- [webonyx/graphql-php](https://github.com/webonyx/graphql-php)
- [Lighthouse](https://lighthouse-php.com/)
- [Laravel](https://laravel.com/)
- [GraphQL](https://graphql.org/)

## Security

If you discover any security-related issues, please email hi@odder.dev instead of using the issue tracker.
