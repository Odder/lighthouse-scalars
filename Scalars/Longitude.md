# Longitude

A float value representing a Longitude. The value must be within the range of -180 to 180.

Examples:

- `-74.0060` - New York City Longitude
- `-0.1278` - London Longitude
- `2.3522` - Paris Longitude
- `-118.2437` - Los Angeles Longitude

### Coercions

The value is coerced to a float.

Supports input as sexagesimal degrees (DMS) in the format `40° 26' 46" N` or `40° 26' 46" W`.

### Validations

The value is validated to be within the range of -180 to 180.

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
