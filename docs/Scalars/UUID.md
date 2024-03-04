# UUID (UUID4)

### Description

The `UUID` scalar type represents textual data, specifically a UUID string. The UUID is generated using the [UUID version 4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) standard.

Examples:

- `550e8400-e29b-41d4-a716-446655440000`
- `f47ac10b-58cc-4372-a567-0e02b2c3d479`
- `d9e4b4e2-3e6f-4f3a-8a3f-3f6dd9d9d3d0`

### Coercions

The UUID string is coerced to a string.

### Validations

The UUID string is validated using a simple regular expression following the [UUID version 4](https://en.wikipedia.org/wiki/Universally_unique_identifier#Version_4_(random)) standard.

### Usage

```graphql
# schema.graphql
type Query {
  user(id: UUID!): User!
}

type User {
  id: UUID!
  name: String!
}
```

```graphql
# request
query {
  user(id: "550e8400-e29b-41d4-a716-446655440000") {
    id
    name
  }
}

# {
#   "data": {
#     "user": {
#       "id": "550e8400-e29b-41d4-a716-446655440000",
#       "name": "John Doe"
#     }
#   }
# }
```
