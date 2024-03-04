# Latitude

### Description

A float value representing a Longitude. The value must be within the range of -90 to 90.

Examples:

- `40.7128` - New York City Latitude
- `51.5074` - London Latitude
- `48.8566` - Paris Latitude
- `34.0522` - Los Angeles Latitude
- `-23.5505` - São Paulo Latitude

### Coercions

The value is coerced to a float.

Supports input as sexagesimal degrees (DMS) in the format `40° 26' 46" N` or `40° 26' 46" W`.

### Validations

The value is validated to be within the range of -90 to 90.

### Usage

```graphql
# schema.graphql
type Query {
    location: Coordinate!
}

type Coordinate {
    latitude: Latitude!
    longitude: Longitude!
}
```

```graphql
# request
query {
  location {
    latitude
    longitude
  }
}

# {
#   "data": {
#     "location": {
#       "latitude": 40.7128,
#       "longitude": -74.0060
#     }
#   }
# }
```
