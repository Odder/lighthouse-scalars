# Markdown

### Description

Following the [Markdown](https://en.wikipedia.org/wiki/Markdown) standard, the `Markdown` scalar type represents textual data, specifically a Markdown string.

Examples:

- `# Title`
- `## Subtitle`
- `### Subsubtitle`
- `Hello **World**`

### Coercions

The Markdown string is coerced to a string.

### Validations

The Markdown string is not currently validated.

### Usage

```graphql
# schema.graphql
type Query {
  post(content: Markdown!): Post!
}

type Post {
  title: String!
  content: Markdown!
}
```

```graphql
# request
query {
  post(content: "# Hello, World!") {
    title
    content
  }
}

# {
#   "data": {
#     "post": {
#       "title": "Hello, World!",
#       "content": "# Hello, World!"
#     }
#   }
# }
```
