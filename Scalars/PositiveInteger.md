# Positive Integer

### Description

The `PositiveInteger` scalar type represents a positive integer. 0 is considered a positive integer. The `PositiveInteger` is limited by the Int type of PHP and thus is limited to the range of 0 to 2,147,483,647 (2^31 - 1). 

Examples:

- `0`
- `1`
- `2`

### Coercions

The positive integer is coerced to an integer.

### Validations

The positive integer is validated using the `is_int` function. The positive integer is also validated to be greater than or equal to 0.

### Usage

```graphql

# schema.graphql
type Query {
  count: PositiveInteger!
}
```

```graphql
# request
query {
  count
}

# {
#   "data": {
#     "count": 30
#   }
# }
```
