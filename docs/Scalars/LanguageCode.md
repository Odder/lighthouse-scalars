# LanguageCode

### Description

Following the [ISO 639-1](https://en.wikipedia.org/wiki/ISO_639-1) standard, the `LanguageCode` scalar type represents textual data, specifically a language code. The language code is a two-letter code that represents a language.

Examples:

- `en` - English
- `es` - Spanish
- `fr` - French
- `de` - German
- `it` - Italian

### Coercions

The language code is coerced to lowercase.

### Validations

The language code is validated using the [ISO 639-1](https://en.wikipedia.org/wiki/ISO_639-1) standard.

### Usage

```graphql
# schema.graphql
type Query {
  translation(language: LanguageCode!): Translation!
}

type Translation {
  text: String!
  language: LanguageCode!
}
```

```graphql
# request
query {
  translation(language: "en") {
    text
    language
  }
}

# {
#   "data": {
#     "translation": {
#       "text": "Hello World",
#       "language": "en"
#     }
#   }
# }
```
