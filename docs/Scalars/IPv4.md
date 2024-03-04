# IPv4

### Description

Following the [IPv4](https://en.wikipedia.org/wiki/IPv4) standard, the `IPv4` scalar type represents textual data, specifically an IPv4 address.

Examples:

- `123.23.12.143`
- `93.23.0.1`
- `128.0.0.1`

### Coercions

The IPv4 address is coerced to a string.

### Validations

The IPv4 address is validated using the [IPv4](https://en.wikipedia.org/wiki/IPv4) standard. Using the `filter_var` function with the `FILTER_VALIDATE_IP` filter.

### Usage

```graphql
# schema.graphql
type Query {
  server(ip: IPv4!): Server!
}

type Server {
  name: String!
  ip: IPv4!
}
```

```graphql
# request
query {
  server (ip: "128.0.0.1") {
    name
    ip
  }
}

# {
#   "data": {
#     "server": {
#       "name": "Server 1",
#       "ip": "128.0.0.1"
#     }
#   }
# }
```
