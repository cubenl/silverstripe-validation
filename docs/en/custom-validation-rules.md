# Custom Validation Rules
You could create a Custom Validation Rule by creating a new class that implements the
`SilverStripe\Validation\Interfaces|Rule` interface.

```php
<?php

use SilverStripe\Validation\Interfaces\Rule;

/**
 * Class Uppercase
 */
class UpperCase implements Rule
{

    /**
     * @var string
     */
    public static $name = 'uppercase';

    /**
     * @param $value
     * @return bool
     */
    public function passes($value): bool
    {
        return strtoupper($value) === $value;
    }

}
```

Now the validation rule property name `uppercase` is available.

```php
/**
 * @return array
 */
public function rules(): array
{
    return [
        'Name' => 'required|uppercase' // New rule uppercase added here
    ];
}
```
