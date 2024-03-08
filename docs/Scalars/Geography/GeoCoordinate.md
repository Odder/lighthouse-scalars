# GeoCoordinate

### Description

** SHOULD NOT BE USED DIRECTLY **

A float value representing a geographic coordinate. The value must be within the range of -90 to 90 for latitude and -180 to 180 for longitude.

Examples:

- `40.7128` - New York City Latitude
- `-74.0060` - New York City Longitude
- `51.5074` - London Latitude
- `-0.1278` - London Longitude
- `48.8566` - Paris Latitude
- `2.3522` - Paris Longitude
- `34.0522` - Los Angeles Latitude
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
    location: Location!
}

type Location {
  name: String!
  coordinate: [GeoCoordinate!]!
}
```

```graphql
# request
query {
  location {
    name
    coordinate
  }
}

# {
#   "data": {
#     "location": {
#       "name": "New York City",
#       "coordinate": [40.7128, -74.0060]
#     }
#   }
# }
```
