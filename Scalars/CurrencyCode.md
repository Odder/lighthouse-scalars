# Currency Code

Following the [ISO 4217 standard](https://en.wikipedia.org/wiki/ISO_4217), the currency code is a three-letter code that represents a currency.

Examples:

- `USD` - United States Dollar
- `CAD` - Canadian Dollar
- `GBP` - British Pound
- `EUR` - Euro
- `JPY` - Japanese Yen

*Please note: Cryptocurrencies are not included in this standard.*

### Coercions

The currency code is coerced to uppercase.

### Validations

The currency code is validated using the [ISO 4217 alpha-3](https://en.wikipedia.org/wiki/ISO_4217) standard.

### Usage

```graphql
# schema.graphql
type Query {
  currency(code: CurrencyCode!): Currency!
}

type Currency {
  name: String!
  code: CurrencyCode!
}
```

```graphql
# request
query {
  currency(code: "USD") {
    name
    code
  }
}

# {
#   "data": {
#     "currency": {
#       "name": "United States Dollar",
#       "code": "USD"
#     }
#   }
# }
```
