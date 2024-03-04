# Country Code

Following the ISO 3166-1 alpha-2 standard, the country code is a two-letter code that represents a country. The following table lists the country codes for all countries and territories.

Examples:
- `US` - United States
- `CA` - Canada
- `GB` - United Kingdom
- `FR` - France

### Usage

```graphql
type Query {
  country(code: CountryCode!): Country!
}

type Country {
  name: String!
  code: CountryCode!
}
```

```graphql
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
