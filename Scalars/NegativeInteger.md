# Negative Integer

### Description

The `NegativeInteger` scalar type represents a negative integer. 0 is considered a negative integer. The `NegativeInteger` is limited by the Int type of PHP and thus is limited to the range of -2,147,483,648 (-2^31) to 0.

Examples:

- `0`
- `1`
- `2`

### Coercions

The negative integer is coerced to an integer.

### Validations

The negative integer is validated using the `is_int` function. The negative integer is also validated to be greater than or equal to 0.

### Usage

```graphql

# schema.graphql
type Query {
  count: NegativeInteger!
}
```

```graphql
# request
query {
  count
}

# {
#   "data": {
#     "count": -30
#   }
# }
```
