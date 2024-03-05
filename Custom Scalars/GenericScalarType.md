# GenericScalarType

## Description

A generic scalar type which support out of box coercing and validation. This scalar should support most basic Scalar types.

## Usage

### Simple example

```php
use Odder\LighthouseScalars\Core\GenericScalarType;

class Email extends GenericScalarType
{
    public ?string $description = "The `Email` scalar type represents textual data, specifically an email address.";

    protected function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
```

### Full example

```php
use Odder\LighthouseScalars\Core\GenericScalarType;

class RomanNumeral extends GenericScalarType
{
    protected string $supportedNodeType = \GraphQL\Language\AST\StringValueNode::class
    public ?string $description = "The `RomanNumeral` scalar type a Roman numeral. Data is stored as integers, but displayed as Roman numerals.";

    public function coerce($value): int
    {
        // Convert the Roman numeral to an integer
    }

    public function coerceOut($value): string
    {
        // Convert the integer to a Roman numeral
    }

    protected function isValid($value): bool
    {
        // Validate the integer can be represented as a Roman Numeral (e.g. 1-3999)
    }

    protected function isValidOut($value): bool
    {
        // Validate the Roman numeral is valid
    }
}
```

## Reference

### supportedNodeType

`protected string $supportedNodeType = StringValueNode::class`

The AST node type that this scalar supports. This is used to validate the input type for literals.

By default, this is set to `StringValueNode::class`.

### description

`public ?string $description = null`

The description of the scalar type. This is used to generate documentation.

### coerce($value)

`public function coerce($value): mixed`

Coerce the input value to the expected type. This is used to convert the input value to the expected type.

Exceptions should be thrown if the value cannot be coerced. This will be caught and handled by the GraphQL engine.

### coerceOut($value)

`public function coerceOut($value): mixed`

Coerce the output value to the expected type. This is used to convert the output value to the expected type.

Exceptions should be thrown if the value cannot be coerced. This will be caught and handled by the GraphQL engine.

Default implementation:

```php
public function coerceOut($value): mixed
{
    return $this->coerce($value);
}
```

### isValid($value)

`protected function isValid($value): bool`

Validate the input value. This is used to validate the input value. Return `true` if the value is valid, `false` otherwise.

### isValidOut($value)

`protected function isValidOut($value): bool`

Validate the output value. This is used to validate the output value. Return `true` if the value is valid, `false` otherwise.

Default implementation:

```php
protected function isValidOut($value): bool
{
    return $this->isValid($value);
}
```
