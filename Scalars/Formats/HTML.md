# HTML

### Description

String representing HTML content.

### Coercions

No coercions are applied to the HTML content.

### Validations

The HTML content is validated using the [HTML Purifier](http://htmlpurifier.org/) library.

### Usage

```graphql
# schema.graphql
type Query {
  post(id: ID!): Post!
}

type Post {
  title: String!
  content: HTML!
}
```

```graphql
# request
query {
  post(id: "1") {
    title
    content
  }
}

# {
#   "data": {
#     "post": {
#       "title": "Hello, World!",
#       "content": "<p>Hello, World!</p>"
#     }
#   }
# }
```
