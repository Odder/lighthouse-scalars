# URL

### Description

Following the [RFC 3986](https://tools.ietf.org/html/rfc3986) standard, the `URL` scalar type represents textual data, specifically a URL string. Only URLs with the `http` and `https` schemes are supported.

Examples:

- `http://example.com`
- `https://example.com`
- `http://example.com/path`
- `https://example.com/path`
- `http://example.com/path?query=value`
- `http://example.com/path?query=value#fragment`
- `http://example.com:8080`

### Coercions

The URL string is coerced to a string.

### Validations

The URL string is validated using the `parse_url` function. Only URLs with the `http` and `https` schemes are supported.

### Usage

```graphql
# schema.graphql
type Query {
  website(url: URL!): Website!
}

type Website {
  title: String!
  url: URL!
}
```

```graphql
# request
query {
  website(url: "https://example.com") {
    title
    url
  }
}

# {
#   "data": {
#     "website": {
#       "title": "Example Domain",
#       "url": "https://example.com"
#     }
#   }
# }
```
