# Email

Following the [RFC 5322](https://tools.ietf.org/html/rfc5322) standard, the `Email` scalar type represents textual data, specifically an email address.

### Coercions

No coercions are applied to the email address.

### Validations

The email address is validated using the [RFC 5322](https://tools.ietf.org/html/rfc5322) standard. Using the `filter_var` function with the `FILTER_VALIDATE_EMAIL` filter.

### Usage

```graphql
# schema.graphql
type Query {
  user(email: Email!): User!
}

type User {
  name: String!
  email: Email!
}
```

```graphql
# request
query {
  user(email: "example@example.org") {
    name
    email
  }
}

# {
#   "data": {
#     "user": {
#       "name": "Example",
#       "email": "example@example.org"
#     }
#   }
# }
```
