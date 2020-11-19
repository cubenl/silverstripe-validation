# Validating DataObjects
Lets say you would like to validate a DataObject called `Customer` within the `App\Models` namespace.

Just implement the `SilverStripe\Validation\Interfaces\ValidationRules` interface and define the `rules` method.

```php
<?php

namespace App\Models;

use SilverStripe\ORM\DataObject;
use SilverStripe\Validation\Interfaces\ValidationRules;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends DataObject implements ValidationRules
{
    /**
     * @var array
     */
    private static $db = [
        'Name' => 'Varchar(255)',
        'Age'  => 'Int(2)'
    ];

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'Name' => 'required|min_length:2|max_length:255',
            'Age'  => 'required|min:18'
        ];
    }

}
```

Now whenever we try to insert a `Customer` into the database, 
the above validation rules will apply.

```php
// This will result in a validation error 
// because a "Customer" needs to have a Age of at least 18.
Customer::create([
    'Name' => 'John',
    'Age' => 16
])->write();
```
