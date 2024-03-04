# Country Code

Following the ISO 3166-1 alpha-2 standard, the country code is a two-letter code that represents a country.

Examples:

- `US` - United States
- `CA` - Canada
- `GB` - United Kingdom
- `FR` - France

### Coercions

The country code is coerced to uppercase.

### Validations

The country code is validated using the [ISO 3166-1 alpha-2](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) standard.

### Usage

```graphql
# schema.graphql
type Query {
  country(code: CountryCode!): Country!
}

type Country {
  name: String!
  code: CountryCode!
}
```

```graphql
# request
query {
  country(code: "US") {
    name
    code
  }
}

# {
#   "data": {
#     "country": {
#       "name": "United States",
#       "code": "US"
#     }
#   }
# }
```
