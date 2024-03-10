# DateTime

### Description

The `DateTime` scalar type represents a date and time value as specified by UTC [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601). The `DateTime` type is a string and must be in the format `YYYY-MM-DDTHH:MM:SS.SSSSSSZ`.

### Example

```graphql
# schema.graphql
type Query {
  event(id: ID!): Event
}

type Event {
  id: ID!
  name: String!
  startDateTime: DateTime!
  endDateTime: DateTime!
}
```

```graphql
# Request
query {
  event(id: 1) {
    id
    name
    startDateTime
    endDateTime
  }
}

# Response
# {
#   "data": {
#     "event": {
#       "id": "1",
#       "name": "New Year's Eve Party",
#       "startDateTime": "2021-12-31T23:59:59.999999Z",
#       "endDateTime": "2022-01-01T00:00:00.000000Z"
#     }
#   }
# }
```
