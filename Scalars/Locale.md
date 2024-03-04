# Locale (simple format)

### Description

Following the [BCP 47](https://tools.ietf.org/html/bcp47) standard, the `Locale` scalar type represents textual data, specifically a locale code. The locale code is a string that represents a combination of a language and a region.

This scalar only supports the `language` and `language-region` formats.

Examples:

- `en` - English
- `es-CO` - Spanish (Colombia)
- `fr-Be` - French (Belgium)
- `de-CH` - German (Switzerland)
- `it-IT` - Italian (Italy)
- `it` - Italian

### Coercions

The language code is coerced to lowercase. The region code is coerced to uppercase. The language and region codes are separated by a hyphen (`-`).

Supports input with `_` as well

Examples:

- `en` -> `en`
- `EN` -> `en`
- `en_US` -> `en-US`
- `en_us` -> `en-US`
- `EN_US` -> `en-US`
- `en-us` -> `en-US`

### Validations

The locale code is validated in two steps, first the language code is validated using the [ISO 639-1](https://en.wikipedia.org/wiki/ISO_639-1) standard, and then the region code is validated using the [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) standard.

### Usage

```graphql
# schema.graphql
type Query {
  translation(locale: Locale!): Translation!
}

type Translation {
  text: String!
  locale: Locale!
}
```

```graphql
# request
query {
  translation(locale: "en-US") {
    text
    locale
  }
}

# {
#   "data": {
#     "translation": {
#       "text": "Hello World",
#       "locale": "en-US"
#     }
#   }
# }
```
