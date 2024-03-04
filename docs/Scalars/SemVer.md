# SemVer

### Description

Following the [Semantic Versioning](https://semver.org/) standard, the `SemVer` scalar type represents textual data, specifically a semantic version.

Examples:

- `1.0.0`
- `2.3.4`
- `3.0.0`
- `3.0.1-alpha`
- `3.0.1-alpha.1`

### Coercions

The semantic version is coerced to a string.

### Validations

The semantic version is validated using the [Semantic Versioning](https://semver.org/) standard.

### Usage

```graphql
# schema.graphql
type Query {
  version: SemVer!
}
```

```graphql
# request
query {
  version
}

# {
#   "data": {
#     "version": "1.0.0"
#   }
# }
```
