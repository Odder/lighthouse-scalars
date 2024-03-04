# JSON

### Description

Following the [RFC 7159](https://tools.ietf.org/html/rfc7159) standard, the `JSON` scalar type represents textual data, specifically a JSON string.

### Coercions

The JSON string is coerced to a string.

### Validations

The JSON string is validated using `json_decode` function.

### Usage

```graphql
# schema.graphql
type Query {
  config: JSON!
}
```

```
# request
query {
  config
}

# {
#   "data": {
#     "config": "{\"key\": \"value\"}"
#   }
# }
```
