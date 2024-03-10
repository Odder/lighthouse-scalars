# Time

### Description

The `Time` scalar type represents a time value as specified by [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601). The `Time` type is a string and must be in the format `HH:MM:SS`.

### Example

```graphql
# schema.graphql
type Query {
  shop(id: ID!): Shop
}

type Shop {
  id: ID!
  name: String!
  openingTime: Time!
  closingTime: Time!
}
```

```graphql
# Request
query {
  shop(id: 1) {
    id
    name
    openingTime
    closingTime
  }
}

# Response
# {
#   "data": {
#     "shop": {
#       "id": "1",
#       "name": "John's Shop",
#       "openingTime": "08:00:00",
#       "closingTime": "18:00:00"
#     }
#   }
# }
```
