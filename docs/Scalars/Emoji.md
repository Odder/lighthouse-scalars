# Emoji

String expecting exactly one unicode emoji.

Examples:

- `🙂`
- `👍`
- `🍕`
- `🚀`
- `🎉`
- `🔥`

### Coercions

No coercions are applied to the emoji.

### Validations

The emoji is validated using the [emoji-detector-php](https://github.com/aaronpk/emoji-detector-php) library.

### Usage

```graphql
# schema.graphql
type Query {
  mood: Emoji!
}
```

```graphql
# request
query {
  mood
}
```

```json
{
  "data": {
    "mood": "🙂"
  }
}
```