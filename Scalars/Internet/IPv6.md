# IPv6

### Description

Following the [RFC 4291](https://tools.ietf.org/html/rfc4291) standard, the `IPv6` scalar type represents textual data, specifically an IPv6 address.

Examples:

- `2001:0db8:85a3:0000:0000:8a2e:0370:7334`

### Coercions

The IPv6 address is coerced to a string.

### Validations

The IPv6 address is validated using the [RFC 4291](https://tools.ietf.org/html/rfc4291) standard. Using the `filter_var` function with the `FILTER_VALIDATE_IP` filter.

### Usage

```graphql
# schema.graphql
type Query {
  server(ip: IPv6!): Server!
}

type Server {
  name: String!
  ip: IPv6!
}
```

```graphql
# request
query {
  server (ip: "2001:0db8:85a3:0000:0000:8a2e:0370:7334") {
    name
    ip
  }
}

# {
#   "data": {
#     "server": {
#       "name": "Server 1",
#       "ip": "2001:0db8:85a3:0000:0000:8a2e:0370:7334"
#     }
#   }
# }
```
