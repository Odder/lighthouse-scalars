# Lighthouse Scalars

This package provides a set of custom scalars for the [Lighthouse](https://lighthouse-php.com/) GraphQL server for Laravel. The scalars are designed to provide more specific validation and serialization for common data types.

## Installation

You can install the package via composer:

```bash
composer require odder/lighthouse-scalars
```

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

## Usage

To use a scalar, you must first register it with your Lighthouse server. You can do this by adding the scalar to the `scalars` array in your `lighthouse.php` configuration file:

```php
'scalars' => [
    \Odder\LighthouseScalars\Scalars\PositiveFloat::class,
    \Odder\LighthouseScalars\Scalars\NonNegativeFloat::class,
    \Odder\LighthouseScalars\Scalars\PositiveInt::class,
    \Odder\LighthouseScalars\Scalars\NonNegativeInt::class,
    // Add more scalars as necessary
],
```

### Testing

This package includes a set of tests for each scalar. To run the tests, use the following command:

```bash
composer test
```

## Documentation

For more information on how to use each scalar, please refer to the [documentation](https://odder.github.io/lighthouse-scalars/docs).

## Contributing

Contributions are welcome! Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this project.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Odder](https://www.github.com/odder)
- [All Contributors](../../contributors)
- [Lighthouse](https://lighthouse-php.com/)
- [Laravel](https://laravel.com/)
- [GraphQL](https://graphql.org/)

## Security

If you discover any security-related issues, please email [

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

