# URI

### Description

Following the [RFC 3986](https://tools.ietf.org/html/rfc3986) standard, the `URI` scalar type represents textual data, specifically a URI string.

Examples:

- `http://example.com`
- `ftp://example.com`
- `ssh://example.com`

### Coercions

The URI string is coerced to a string.

### Validations

The URI string is validated using the `parse_url` function.

### Usage

```graphql
# schema.graphql
type Query {
  resource(uri: URI!): Resource!
}

type Resource {
  title: String!
  uri: URI!
}
```

```graphql
# request
query {
  resource(uri: "http://example.com") {
    title
    uri
  }
}

# {
#   "data": {
#     "resource": {
#       "title": "Example Domain",
#       "uri": "http://example.com"
#     }
#   }
# }
```
