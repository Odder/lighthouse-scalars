# Date

### Description

The `Date` scalar type represents a date value as specified by [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601). The `Date` type is a string and must be in the format `YYYY-MM-DD`.
The underlying value is converted to a `Carbon` instance.

### Example

```graphql
# schema.graphql
type Query {
  user(id: ID!): User
}

type User {
  id: ID!
  name: String!
  birthDate: Date!
}
```

```graphql
# Request
query {
  user(id: 1) {
    id
    name
    birthDate
  }
}

# Response
# {
#   "data": {
#     "user": {
#       "id": "1",
#       "name": "John Doe",
#       "birthDate": "1990-01-01"
#     }
#   }
# }
```
