# JWT

### Description

The `JWT` scalar type represents a JSON Web Token. The `JWT`'s format will be validated, but the token's payload will not be validated.

### Example

```graphql
# schema.graphql
type Query {
  user(id: ID!): User
}

type User {
  id: ID!
  name: String!
  token: JWT!
}
```

```graphql
# Request
query {
  user(id: 1) {
    id
    name
    token
  }
}

# Response
# {
#   "data": {
#     "user": {
#       "id": "1",
#       "name": "John Doe",
#       "token
#     }
#   }
# }
```
